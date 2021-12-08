# MongoLAMP

This is a quick docker-compose script and Dockerfile for getting a LAMP stack with a MongoDB backend installed and running. In this case the 'M' in LAMP is for Mongo.

A very quick test site collecting user input, creating a database, and inserting the values is provided as a reference on how to interact with MongoDB via PHP.

## Getting started

After the git clone to a local device with Docker and docker-compose installed, navigate to the folder of the docker-compose.yml file and edit the default MongoDB username and password to something more secure. Be sure to do this in both the mongo and mongo-express services. Container names can also be set based on user preference.

Once modified just run docker-compose up (on Linux sudo privileges are required).

NOTE: If the default login was changed, the php files (i.e. insertnames.php in this example) will also need to adjust the access rights on MongoDB\Client("mongodb://'MongoDB user':'MongoDB pasword'@mongo:27017");

## On start

Once the containers are running, open a browser and just go to the localhost. The simple test page (index.html) should show. Entering a name and age and submit will create a MongoDB database called gettingstarted and insert the user information that was entered. 

To use Mongo-Express it is set to port 8081 by default. From the browser navigate to localhost:8081 and it should come up.

## Tips and troubleshooting

Composer:<br>
Installing composer with the volume mount was the most difficult part to figure out. Initially it kept overwriting the 'composer require mongodb/mongodb' values once the container started because the build takes place than mounts the local volume to the same location. At least, that is what I think was happening...

Forcing the directory to /var/www in the 'composer require --working-dir=/var/www mongodb/mongodb' command installs the library packages, outside the mount point avoiding the issue. However, since the mongodb library dependencies are not in the root directory of the web server the full path to them needs to be provided in the PHP script - shown in the example.

The Dockerfile and reference website code should demonstrate the logic.

Mongo-Express:<br>
If when first running the 'docker-compose up' command the mongo-express container fails to connect it will close. I've tried to link this and create a dependency to the mongodb container. However, a few times it failed to connect. I believe this is a timing issue if it starts before the mongodb container is ready. 

Once the docker-compose up finishes and both the mongodb and Apache:PHP containers are running, simply run docker start mongoex (or whatever the name of the conatiner is) to get it working. 

Auto restart the containers:<br>
The containers can be set to auto restart by using the - restart flag in the docker-compose. Parameters of 'always' or 'unless-stopped' can be added. The official MongoDB images on the docker hub use the 'restart;always' flag, but I personally prefer 'unless-stopped' for slightly easier management in case you need to update an image or perform other maintenance tasks. 

More info about the behavior is available on the Docker site: https://docs.docker.com/config/containers/start-containers-automatically/

## References:

Official documentation on using PHP with MongoDB: <br>
https://docs.mongodb.com/drivers/php/

Official Docker image for MongoDB and Mongo-Express:<br>
https://hub.docker.com/_/mongo<br>
(This was the base for the docker compose minus the apache PHP image)
  
Another great tutorial which is worth a look as well. <br>
https://www.javatpoint.com/php-mongodb
  
  
  
