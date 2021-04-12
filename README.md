# swoole-example
A simple swoole example web app returning a random list of programming languages formatted as json

## How to
- use `docker-compose` to start the docker container running this app: `docker-compose up`
- open `http://0.0.0.0:8080` in your browser (or call it via curl) 
- change the code to see how it behaves
- test it, i.e. via `ab`: `ab -c500 -n500 http://0.0.0.0:8080` and see for yourself

