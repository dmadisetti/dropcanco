import re
import sys
import urllib
import requests
from subprocess import Popen, PIPE
from requests_oauthlib import OAuth1, OAuth2Session


def authenticate():
	return OAuth1('58q2CbJPbkBKhttJ9hNq0xgSL',
          client_secret='LMoX0eH9MqCYddBSbGSMJis0Sj3R9FZbbeRsTa2Z3GR1ZOvGdY',
          resource_owner_key='2719929684-R2QfCtfFjRLkUwOD7xdyDY2PbllbXcFJW1dYBUW',
          resource_owner_secret='uRiHzoc8tmGfq6bgxx4gAr8knKOAk0s15OF83Gw1KPjqh'
    )


def tweet(status):
	oauth = authenticate()
	status = urllib.quote_plus(re.sub('<[^>]*>', '', status[:140]))
	response = requests.post(url="https://api.twitter.com/1.1/statuses/update.json?status=%s" % status, auth=oauth).json() 
	print(response)


def run(f,**kwargs):
	# connect
	process = Popen('mysql dropcan -u%s -p%s -h $(sudo docker inspect mysql | grep IPAddress | grep -o "[0-9]*\.[0-9]*\.[0-9]*\.[0-9]*")' % ("garbageman", "password"), stdout=PIPE, stdin=PIPE, shell=True)
	args = ""
	base = "~/twitterbot/"
	if len(sys.argv) == 3:
		base = sys.argv[2]

	for key in kwargs:
		args += 'set @%s=\'%s\'; \n' % (key,re.escape(kwargs[key]))
	return re.sub('\\n', ' '," ".join(process.communicate(args + ('source %sscripts/%s.sql' % (base,f)))[0].split("\n")[3:]))


def post():
	tweet(run('to'))


def discover():
	oauth = authenticate()
	response = requests.get(url="https://api.twitter.com/1.1/search/tweets.json?q=%40dropcanco", auth=oauth).json()
	for status in response.get('statuses',[]):

		text = re.sub('<[^>]*>', '', status['text'])
		text = re.sub(r"(https?://\S+\.?\S+\.\S+)", r"<a href='\1'>\1</a>", text)
		text = re.sub(r"(\#[a-zA-Z0-9]*)", r"<b class='hastag'>\1</b>", text)
		text = re.sub(r"(\@[a-zA-Z0-9]*)", r"<b class='at'>\1</b>", text)

		run('read',status=text,setting="twitter",)

({
	"post"	   :post,
	"discover" :discover
}.get(sys.argv[1]))()
