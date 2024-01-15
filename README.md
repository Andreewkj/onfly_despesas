# Configuração do Projeto
Faça o download do projeto <br>
git clone https://github.com/Andreewkj/onfly_despesas.git

## Configuração .env

Renomear o .env.exemple para .env <br>
trocar o valor de queue_connectin para database -> QUEUE_CONNECTION=database <br>

Vá até o site https://mailtrap.io/ e crie uma conta gratuita.<br>
Depois vá até Testing>inboxes>myinbox>SMTP Settings selecione laravel 9+ na listagem de integrações e cole o conteudo no .env do projeto.
<br>

```bash
MAIL_MAILER=smtp
MAIL_HOST=sandbox.smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=b3efe82420bbf1
MAIL_PASSWORD=1dcbd2d9703325
```
<br>

Configurar as variáveis do banco de dados
```bash
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=onfly_despesas
DB_USERNAME=sail
DB_PASSWORD=password
```

## Configuração Sail

Rodar este comando para instalar as dependências
e fazer o bind do volume com o container.

```bash
docker run --rm --interactive --tty \
  --volume $PWD:/app \
  --user $(id -u):$(id -g) \
  composer install
```

Suba o sail

```bash
./vendor/bin/sail up -d
```
## Configuração JWT

Rode o comando ```./vendor/bin/sail artisan jwt:secret``` para que a autentificação seja configurada no projeto

## Banco de dados

Execute o comando para rodar as migrations
```bash
./vendor/bin/sail artisan migrate
```

# Sobre o projeto

O projeto foi desenvolvido para o teste técnico da empresa Onfly. <br>
O objetivo do projeto é criar uma api onde o usuário possa registrar seus gastos e também manipular esses dados através das operações de CRUD.<br>
This is a challenge by Coodesh

Framework do projeto <br>
<p align="left"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="120" alt="Laravel Logo"></a></p>

## Entidades criadas

Foram criadas apenas duas entidade no projeto<br>
Expenditure e User.<br>
Cada usuario pode registrar varias criações de desdepesas e toda despesa pode ter apenas um usuário.<br>

Foi escolhida a palavra 'Expenditure' pois a palavra 'Expense' acaba remetendo a um gasto e Expenditure se encaixa mais como despesa, como água e Luz por exemplo.<br>

## Autentificação
Foi usado a biblioteca [tymondesigns/jwt-auth](https://github.com/tymondesigns/jwt-auth) na versão 2.0 

## Roteirização
> [!TIP]
> Vou deixar o curl das rotas para facilitar na montagem do ambiente
### User

**Create** <br>
curl --request POST \
  --url http://localhost/api/v1/user \
  --header 'Content-Type: application/json' \
  --data '{
	"name" : "Fulano de taeal",
	"email": "fulanaawo@gmail.com",
	"password": "123456"
}'
<br><br>
**List** <br>
curl --request GET \
  --url http://localhost/api/v1/user
<br><br>

### Auth

**Login** <br>
curl --request POST \
  --url http://localhost/api/v1/login \
  --header 'Content-Type: application/json' \
  --data '{
	"email": "fulano@gmail.com",
	"password": "123456"
}'
<br><br>
**Logout** <br>
curl --request GET \
  --url http://localhost/api/v1/logout \
  --header 'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0L2FwaS92MS9sb2dpbiIsImlhdCI6MTcwNTIwNjIyMCwiZXhwIjoxNzA1MjA5ODIwLCJuYmYiOjE3MDUyMDYyMjAsImp0aSI6InFKVmhaVEh1bG9pajdzeXMiLCJzdWIiOiIyIiwicHJ2IjoiMjNiZDVjODk0OWY2MDBhZGIzOWU3MDFjNDAwODcyZGI3YTU5NzZmNyJ9.1GpuTbxbxjLdPNrLnFuCcUOsYXXCz6P_LR88PLe9tx8'
<br><br>

### Expenditure

**Create** <br>
curl --request POST \
  --url http://localhost/api/v1/expenditure \
  --header 'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0L2FwaS92MS9sb2dpbiIsImlhdCI6MTcwNTIwNjIyMCwiZXhwIjoxNzA1MjA5ODIwLCJuYmYiOjE3MDUyMDYyMjAsImp0aSI6InFKVmhaVEh1bG9pajdzeXMiLCJzdWIiOiIyIiwicHJ2IjoiMjNiZDVjODk0OWY2MDBhZGIzOWU3MDFjNDAwODcyZGI3YTU5NzZmNyJ9.1GpuTbxbxjLdPNrLnFuCcUOsYXXCz6P_LR88PLe9tx8' \
  --header 'Content-Type: application/json' \
  --data '{
	"description" : "Creatina 600gr",
	"value": 132.89
}'
<br><br>

**Update** <br>
curl --request PUT \
  --url http://localhost/api/v1/expenditure/1 \
  --header 'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0L2FwaS92MS9sb2dpbiIsImlhdCI6MTcwNTIwNjIyMCwiZXhwIjoxNzA1MjA5ODIwLCJuYmYiOjE3MDUyMDYyMjAsImp0aSI6InFKVmhaVEh1bG9pajdzeXMiLCJzdWIiOiIyIiwicHJ2IjoiMjNiZDVjODk0OWY2MDBhZGIzOWU3MDFjNDAwODcyZGI3YTU5NzZmNyJ9.1GpuTbxbxjLdPNrLnFuCcUOsYXXCz6P_LR88PLe9tx8' \
  --header 'Content-Type: application/json' \
  --data '{
	"description" : "Creatina 800gr",
	"value": "229.89"
}'
<br><br>

**Delete** <br>
curl --request DELETE \
  --url http://localhost/api/v1/expenditure/49 \
  --header 'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0L2FwaS92MS9sb2dpbiIsImlhdCI6MTcwNTIwNjIyMCwiZXhwIjoxNzA1MjA5ODIwLCJuYmYiOjE3MDUyMDYyMjAsImp0aSI6InFKVmhaVEh1bG9pajdzeXMiLCJzdWIiOiIyIiwicHJ2IjoiMjNiZDVjODk0OWY2MDBhZGIzOWU3MDFjNDAwODcyZGI3YTU5NzZmNyJ9.1GpuTbxbxjLdPNrLnFuCcUOsYXXCz6P_LR88PLe9tx8'
<br><br>

**List** <br>
curl --request GET \
  --url http://localhost/api/v1/expenditure/ \
  --header 'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0L2FwaS92MS9sb2dpbiIsImlhdCI6MTcwNTIwNjIyMCwiZXhwIjoxNzA1MjA5ODIwLCJuYmYiOjE3MDUyMDYyMjAsImp0aSI6InFKVmhaVEh1bG9pajdzeXMiLCJzdWIiOiIyIiwicHJ2IjoiMjNiZDVjODk0OWY2MDBhZGIzOWU3MDFjNDAwODcyZGI3YTU5NzZmNyJ9.1GpuTbxbxjLdPNrLnFuCcUOsYXXCz6P_LR88PLe9tx8'
<br><br>

**Show** <br>
curl --request GET \
  --url http://localhost/api/v1/expenditure/1 \
  --header 'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0L2FwaS92MS9sb2dpbiIsImlhdCI6MTcwNTIwNjIyMCwiZXhwIjoxNzA1MjA5ODIwLCJuYmYiOjE3MDUyMDYyMjAsImp0aSI6InFKVmhaVEh1bG9pajdzeXMiLCJzdWIiOiIyIiwicHJ2IjoiMjNiZDVjODk0OWY2MDBhZGIzOWU3MDFjNDAwODcyZGI3YTU5NzZmNyJ9.1GpuTbxbxjLdPNrLnFuCcUOsYXXCz6P_LR88PLe9tx8'
<br><br>

## Swagger
Para uma documentação mais completa da Api foi implementado o Swagger, onde é possível ver as rotas e fazer os testes das mesmas. <br>
Foi usado a biblioteca [DarkaOnLine/L5-Swagger]([https://github.com/tymondesigns/jwt-auth](https://github.com/DarkaOnLine/L5-Swagger)) na versão 3.0 <br>

![image](https://github.com/Andreewkj/onfly_despesas/assets/62602623/e3a11992-5eab-4449-921e-41a573e67541)
Assim que o projeto estiver rodando a documentação estará disponível no link http://localhost/api/documentation. <br>

## Email
Assim que uma despesa é cadastrada pela rota de criação, um email é armazenado no banco em uma fila e será necessário rodar o comando 'sail artisan queue:work --tries=3' para que o email seja desparado.
Para realizar o teste do email basta entrar no site https://mailtrap.io/ e com um usuário logado ir até Email Testing>inboxes>myinbox>SMTP Settings selecione laravel 9+ na listagem de integrações e cole o conteudo no .env do projeto.
![image](https://github.com/Andreewkj/onfly_despesas/assets/62602623/03f7da84-72c1-403c-8cf6-3c25b89e73f2)

## License
[MIT license](https://opensource.org/licenses/MIT).
