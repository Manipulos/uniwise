# UNIwise backend opgave:

Opgaven går ud på at vise basal forståelse for nogle af de frameworks vi anvender hos UNIwise. Mere specifik er det de to frameworks: Doctrine og Symfony. 

Kort fortalt bruges Doctrine til at beskrive databasen entities og håndtere kommunikationen til databasen. Symfony anvendes til at opbygge API’er og services. 

For at løse opgaven skal følgende være installeret på computeren: 
```
Docker
Docker-compose
```

## Installation af Docker:
Mac:

“Docker for Mac” kan downloades fra: 
[https://docs.docker.com/docker-for-mac/install/](https://docs.docker.com/docker-for-mac/install/)

"Docker for Mac" indeholder både Docker og Docker-compose 

Ubuntu: 

* Docker:  
```
sudo apt-get update
sudo apt-get install -y curl
sudo su -c 'curl -fsSL https://download.docker.com/linux/ubuntu/gpg | sudo apt-key add -'
sudo add-apt-repository "deb [arch=amd64] https://download.docker.com/linux/ubuntu $(lsb_release -cs) stable"
sudo apt-get -y update
sudo sudo apt-get install -y docker-ce
sudo update-rc.d docker enable
sudo groupadd docker
sudo gpasswd -a ${USER} docker
echo '{"storage-driver": "devicemapper"}' | sudo tee /etc/docker/daemon.json
sudo systemctl restart docker
sudo chown ${USER}:${USER} /var/run/docker.sock 
```

* Docker-compose:  
```
sudo curl -L -o /usr/local/bin/docker-compose $(curl -s https://api.github.com/repos/docker/compose/releases/latest | grep 'browser_' | cut -d\" -f4 | grep Linux | grep -v sha256)
sudo chmod +x /usr/local/bin/docker-compose
```

* Make:
```
sudo apt-get install -y make
```

## Opsætning: 
1. Hent projekt fra git (git clone https://github.com/UNIwise/backend-assignment.git)
2. Gå ind i src mappen og kør: make build
3. Kør: make run
4. Åben [http://localhost/car/all](http://localhost/car/all) og se at der returneres "Not implemented yet"
  
## Opgaven:
Opgaverne bør løses i kronologisk rækkefølge, hvor sværhedsgraden vil variere.

De tre filer som der primært arbejdes med er:
- Symfony/Bundle/ApiBundle/Controller/Car/CarController.php
- Symfony/Service/Car/CarService.php
- Doctrine/Entity/CarRepository.php

De tre filer repræsentere samlet en MVC arkitektur.  

### Opgaver 1: List alle biler i databasen. 

Ved at kalde endpointet: [http://localhost/car/all](http://localhost/car/all) skal alle biler hentes ud af databasen og returneres som JSON. Det er vigtigt at de entities der hentes fra databasen ikke blot returneres direkte, men bliver puttet ind i en form for respons objekt. 

Husk at det er servicen der sammen med et repository tager sig af at hente data ud af databasen. 

### Opgave 2: Tilføj ekstra endpoint til controlleren, hvor det er muligt at filtrere på bilmærker. 

Tilføj endpointet [http://localhost/car/filtered](http://localhost/car/filtered) til controlleren og gøre det muligt at filtrere på bilmærker.

### Opgave 3. Udvidelse af doctrine entities. 
Brug doctrine til at tilføje ekstra tabeller til databasen, som indeholder udstyr og som binder udstyr og en bil sammen. Derefter skal responset opdateres til også at indeholde udstyr. 

Hint: 
1) Opret entitien: Equipment. 
2) Opdatere dens definition, så den matcher definitionen i filen resources/db/equipment.sql og sørg for at relationerne er beskrevet imellem Car og Equipment objekterne. Det skal være muligt for en bil at have mere end et udstyr tilknyttet og samtidig skal et udstyr kunne tilknyttes flere biler. 

Der kan læses om mapping på: 
https://www.doctrine-project.org/projects/doctrine-orm/en/2.6/reference/association-mapping.html#many-to-many-unidirectional

Når de to entities er oprettet, skal følgende kommandoer køres for at tabellerene oprettes i databasen:
1) Make run (sørger for at tilføje de nye tabeller i databasen. Hvis det går godt kan to nye tabeller ses i database (equipment og carEquipment) med korrekte relationer)
2) Make import-equipment (Tilføjer data til databasen)

### Opgave 4. Gør det muligt at tilføje ekstra udstyr til en bil. 
Her er det i orden at antage at id'erne på bilerne og udstyr kendes og derfor blot skal sendes med. 

Tilføj et endpoint, der givet Id’er på en bil og et udstyr opretter en forbindelse imellem dem. 

