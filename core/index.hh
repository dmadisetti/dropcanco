<?hh

# Env settings
# Debug if in Dev
if (getenv("ENV") == "DEV") {
  ini_set("display_startup_errors",1);
  error_reporting(E_ALL);
  set_error_handler( function($errno,$errstr,$errfile,$errline,$errcontext){
    echo sprintf("<p style='list-style:disc outside none; display:list-item;margin-left: 20px;'><strong>Error:</strong> %s in %s on %d</p>\n",$errstr,$errfile,$errline);
  } , E_ALL);
}

// One controller to rule them all
class Controller {

    private $db_server;
    private $query ="SELECT memo ,settings ,from_unixtime(time,'%M %e, %Y, %l:%i %p:') as formatted FROM dropcan ORDER BY time DESC limit 100";
    private $year = 31540000;

    public function __construct(){

        # Load templater
        require "utils/mustache.php";
        $this->stache = new Mustache_Engine(array(
            'loader' => new Mustache_Loader_FilesystemLoader(dirname(__FILE__). '/templates/'),
        ));

        # Where are you going?
        switch($_SERVER["REQUEST_URI"]){
            case "/":
                echo $this->stache->render('main.mustache',$this->index());
                break;
            case "/posts/":
                if(isset($_COOKIE['view'])) echo $this->stache->render('posts.mustache', $this->messages(false));
                else $this->redirect("/");
                break;
            case "/new/":
                echo $this->stache->render('raw_posts.mustache', $this->messages(true));
                break;
            default:
                header("HTTP/1.0 404 Not Found");
                echo $this->stache->render('missing.mustache');
                break;
        }
    }

    private function index(): array{
        $data = array("cookied"=> isset($_COOKIE['view']));

        # Post or get?
        if($_SERVER['REQUEST_METHOD'] == "POST"){
            $data["response"] = $this->post();
            if($data["response"]["success"]){
                setcookie("view", 1, time()+$this->year);
                $this->redirect("/posts/");
            }
        }
        return $data;
    }

    private function post(): array{

        $response = array("success"=> false, "message"=> "Database error.. Our munchkins are on it");

        # Database
        if (!$this->connect()) return $response;

        # Store our message
        $message = htmlspecialchars($this->db_server->real_escape_string($_POST['message']));

        # Meta
        $time  = time();
        $type  = substr($message,0,5) == "*gold" ? "gold" : "memo";
        $message  = $type == "gold" ? substr($message,5) : $message;

        # Hash to prevent collsion
        $hash     = md5($message);

        # Validate
        $clean    = $this->validate($message);
        $original = $this->check($hash) && trim($message) != ''; 
        $short    = 2001 > strlen($message);

        # Insert if I can
        if($clean && $original && $short){
            $message = preg_replace("@https?://\S+\.?\S+\.\S+@", '<a href="\\0">\\0</a>', $message);
            $message = preg_replace("@\#[a-zA-Z0-9]*@", '<b class="hastag">\\0</b>', $message);
            $message = preg_replace("@\@[a-zA-Z0-9]*@", '<b class="at">\\0</b>', $message);
            // Should have used more .sql files as snippets
            $this->db_server->query("INSERT INTO dropcan (memo, hash, time, settings,tweeted) VALUES('$message', '$hash', '$time', '$type',0)") or die(mysql_error()); 
            $response = array("success"=> true, "message"=> "WOW!  So Original of you ;)");
        }else{
            $response["success"] = false;
            $response["message"] = $original ? 
                ($clean ? "Too long friend"
                    : "Please do not post inflammatory speech. Thank you.")
                : "That's already in the dropcan!  So original of you!";
        }
        return $response;
    }


    private function connect(): boolean{
        # Did we already do this?
        if(isset($this->db_server) && $this->db_server)
            return true;
        # Database settings
        $this->db_server = mysqli_connect(getenv("MYSQL_PORT_3306_TCP_ADDR"), getenv("USER"), getenv("PASSWORD")) or die(mysql_error());
        return $this->db_server->select_db(getenv("DATABASE"));
    }

    private function validate($message): boolean{
        return preg_match('/(?:badword|baddddword)/i', $message) == 0;
    }

    private function check($hash): boolean{
        return $this->db_server->query("SELECT * FROM dropcan WHERE hash = '$hash'")->num_rows == 0;
    }

    private function messages($timed): array{
        $response = array("message"=>"Momentary difficulities. We're on it.");
        if (!$this->connect()) return $response;
        $time  = time();
        // Inline sql hurts my soul.
        $query = !$timed? $this->query : "SELECT memo ,settings ,from_unixtime(time,'%M %e, %Y, %l:%i %p:') as formatted FROM dropcan WHERE time > $time - 5 ORDER BY time DESC limit 10";
        return array("data"=>($this->db_server->query($query)->fetch_all(MYSQLI_ASSOC)));
    }

    private function redirect($location): void{
        header('Location: ' . $location);
        status_header(302);
        exit();
    }
}

new Controller();