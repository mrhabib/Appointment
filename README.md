## SabaIdea Task

### Prerequisites:
Docker and Docker-compose

### Step 1:
Copy Example `.env` file 
```bash
$ cp .env.example .env
```

### Step 2:
set `.env` values as expected

### Step 3:
 Build and run Docker containers: after 10 seconds of running, it automatically runs entrypoint.sh to create initial data.
```bash
$ docker-compose up -d
```

### Description
- There is no Authentications system  . For the simplicity of the work, only ID 1 has been used and the times of the day are considered from 9:00 to 18:00.
