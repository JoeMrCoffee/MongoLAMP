# MongoLAMP

This is a quick docker-compose script and Dockerfile for getting a LAMP stack with a MongoDB backend installed and running. 

A very quick test site collecting user input, creating a database, and inserting the values is provided as a reference on how to interact with MongoDB via PHP.

## Getting started

After the git clone to a local device with Docker and docker-compose installed, navigate to the folder of the docker-compose.yml dock and edit the default MongoDB user name and password to something more secure. Be sure to do this in both the mongo and mongo-express services. Container names can also be set based on user preference.

Once modified just run docker-compose up (on Linux sudo privileges are required).

NOTE: If the default login was changed, the php files (i.e. insertnames.php in this example) will also need to adjust the access rights on MongoDB\Client("mongodb://'MongoDB user':'MongoDB pasword'@mongo:27017");

## Tips and troubleshooting

Composer:<br>
What is difficult was installing composer with the volume mount - initially it kept overwriting the 'composer require mongodb/mongodb' values once the container started because the build takes place than mounts the local volume to the same location. At least, that is what I think was happening... 

Forcing the directory to /var/www in the 'composer require --working-dir=/var/www mongodb/mongodb' command installs the library packages, but they need to be explicitly called in the PHP code for the site. Since the mongodb library dependencies are not in the root directory of the webserver the full path to them needs to be provided in the PHP script - shown in the example.

The Dockerfile and reference website code should demonstrate the logic.

Mongo-Express:<br>
If when first running the docker-compose up command the mongo-express container fails to connect it will close. I've tried to link this and create a dependency to the mongodb container, however, a few times it failed to start. Once the docker-compose up finishes and both the mongodb and Apache PHP containers are running, simply run docker start mongoex (or whatever the name of the conatiner is) to get it working. 

## References:

Official documentation on using PHP with MongoDB: <br>
https://docs.mongodb.com/drivers/php/

Official Docker image for MongoDB and Mongo-Express:<br>
https://hub.docker.com/_/mongo<br>
(This was the base for the docker compose minus the apache PHP image)
  
Another great tutorial which is worth a look as well. <br>
https://www.javatpoint.com/php-mongodb
  
  
  
