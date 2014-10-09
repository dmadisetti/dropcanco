import re
import sys
import urllib
import MySQLdb
import requests
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

	response = requests.post(url="https://api.twitter.com/1.1/statuses/update.json?status=%s" % status[:140], auth=oauth).json()
	print(response)
 

def run(f):
	# connect
	db = MySQLdb.connect(host=sys.argv[2], user=sys.argv[3], passwd=sys.argv[4], db="dropcan")
	cursor = db.cursor()

	# execute SQL select statement
	for line in open('scripts/%s.sql' % f):
	    cursor.execute(line)

	# commit your changes
	db.commit()

	return cursor

def post():
	tweet(run('post')[0])

def discover():
	pass

({
	"post"	   :post,
	"discover" :discover
}.get(sys.argv[1]))()
