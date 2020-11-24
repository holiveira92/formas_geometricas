Tecnologias utilizadas:
* PHP 7.4 + Laravel 8 (Back-end)
* Composer Gerenciador de Pacotes PHP
* MYSQL
* PHPUnit (Casos de testes: TrianguloTest.php e RetanguloTest.php)
* Container Docker com ambiente PHP + MYSQL


Endpoints da API de formas geométricas:


API Triangulo

GET: api/triangulo/

GET: api/triangulo/ID

POST: api/triangulo/

PUT: api/triangulo/ID

DELETE: api/triangulo/ID

Body exemplo:

{ "lado_a" : 15, "lado_b" : 13, "lado_c" : 8 }

API Retângulo

GET: api/retangulo/

GET: api/retangulo/ID

POST: api/retangulo/

PUT: api/retangulo/ID

DELETE: api/retangulo/ID

Body exemplo:

{ "base" : 5, "altura" : 6 }
