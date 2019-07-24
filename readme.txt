Hello! 
This is project for booking seats in the cinema. All data are scrapped from Helios cinema, except cinema hall number (I'm working on it. For now, they are temporarily randomized). Using CRON to retrieve and updating data regularly. 

CRON is created as controller to allow fast start-up and testing project since task manager on windows is very frustrating ;)

If you wanna test it at fullest, do not forget to change an email in app/controllers/reservation in function send_reservation_email($data)!



Things to do:
* Scrap hall number (for now it's randomizing number).
* Set max time for reservation steps.