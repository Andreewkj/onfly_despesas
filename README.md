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

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 2000 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[WebReinvent](https://webreinvent.com/)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Jump24](https://jump24.co.uk)**
- **[Redberry](https://redberry.international/laravel/)**
- **[Active Logic](https://activelogic.com)**
- **[byte5](https://byte5.de)**
- **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
