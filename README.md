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
[Upl{"_type":"export","__export_format":4,"__export_date":"2024-01-14T19:24:30.904Z","__export_source":"insomnia.desktop.app:v2023.4.0","resources":[{"_id":"req_9e4eb3dd40ca475c967d804d7003bbf5","parentId":"fld_b37d062da9574c5cac7465396b604d43","modified":1705170985357,"created":1705000825709,"url":"http://localhost/api/v1/expenditure","name":"Expenditure Create","description":"","method":"POST","body":{"mimeType":"application/json","text":"{\n\t\"description\" : \"    Mussum Ipsum, cacilds vidis litro abertis. Morbi viverra placerat justo, vel pharetra turpis. Cevadis im ampola pa arma uma pindureta. Eu nunca mais boto a boca num copo de cachaça\",\n\t\"value\": 111111128.89\n}"},"parameters":[],"headers":[{"name":"Content-Type","value":"application/json","id":"pair_df7d26ddbaf34212b81f5435cd992f44"},{"id":"pair_dc2f4e9e8828439a90cdf1e7982ca489","name":"Authorization","value":"Bearer {% response 'body', 'req_60af1542c9f74e0b9faf3d9fcac7a0ba', 'b64::JC50b2tlbg==::46b', 'never', 60 %}","description":"","disabled":false}],"authentication":{},"metaSortKey":-1705000825709,"isPrivate":false,"settingStoreCookies":true,"settingSendCookies":true,"settingDisableRenderRequestBody":false,"settingEncodeUrl":true,"settingRebuildPath":true,"settingFollowRedirects":"global","_type":"request"},{"_id":"fld_b37d062da9574c5cac7465396b604d43","parentId":"wrk_dbede056adbd48ffa59b70518a592713","modified":1705000770583,"created":1705000770583,"name":"Expenditure","description":"","environment":{},"environmentPropertyOrder":null,"metaSortKey":-1705000770583,"_type":"request_group"},{"_id":"wrk_dbede056adbd48ffa59b70518a592713","parentId":null,"modified":1704985542435,"created":1704985542435,"name":"onfly","description":"","scope":"collection","_type":"workspace"},{"_id":"req_842357160a474db8aecb412b9d2e3fc8","parentId":"fld_b37d062da9574c5cac7465396b604d43","modified":1705176226113,"created":1705006716100,"url":"http://localhost/api/v1/expenditure/1","name":"Expenditure Update","description":"","method":"PUT","body":{"mimeType":"application/json","text":"{\n\t\"description\" : \"Creatina mono hidratada 600gr\",\n\t\"value\": \"229.89\"\n}"},"parameters":[],"headers":[{"name":"Content-Type","value":"application/json","id":"pair_df7d26ddbaf34212b81f5435cd992f44"},{"id":"pair_dc2f4e9e8828439a90cdf1e7982ca489","name":"Authorization","value":"Bearer {% response 'body', 'req_60af1542c9f74e0b9faf3d9fcac7a0ba', 'b64::JC50b2tlbg==::46b', 'never', 60 %}","description":"","disabled":false}],"authentication":{},"metaSortKey":-1704997768083.75,"isPrivate":false,"settingStoreCookies":true,"settingSendCookies":true,"settingDisableRenderRequestBody":false,"settingEncodeUrl":true,"settingRebuildPath":true,"settingFollowRedirects":"global","_type":"request"},{"_id":"req_5b2f48ea8e6349b494cb758b55fc1289","parentId":"fld_b37d062da9574c5cac7465396b604d43","modified":1705171854943,"created":1705008066477,"url":"http://localhost/api/v1/expenditure/49","name":"Expenditure Delete","description":"","method":"DELETE","body":{},"parameters":[],"headers":[{"id":"pair_dc2f4e9e8828439a90cdf1e7982ca489","name":"Authorization","value":"Bearer {% response 'body', 'req_60af1542c9f74e0b9faf3d9fcac7a0ba', 'b64::JC50b2tlbg==::46b', 'never', 60 %}","description":"","disabled":false}],"authentication":{},"metaSortKey":-1704996239271.125,"isPrivate":false,"settingStoreCookies":true,"settingSendCookies":true,"settingDisableRenderRequestBody":false,"settingEncodeUrl":true,"settingRebuildPath":true,"settingFollowRedirects":"global","_type":"request"},{"_id":"req_9ff1a35c2db14f95a553e1d8691047f6","parentId":"fld_b37d062da9574c5cac7465396b604d43","modified":1705171366597,"created":1705004657916,"url":"http://localhost/api/v1/expenditure/","name":"Expenditure List","description":"","method":"GET","body":{},"parameters":[{"id":"pair_c30df0a5c14e4298b19a6697f966074f","name":"page","value":"2","description":"","disabled":true}],"headers":[{"id":"pair_dc2f4e9e8828439a90cdf1e7982ca489","name":"Authorization","value":"Bearer {% response 'body', 'req_60af1542c9f74e0b9faf3d9fcac7a0ba', 'b64::JC50b2tlbg==::46b', 'never', 60 %}","description":"","disabled":false}],"authentication":{},"metaSortKey":-1704994710458.5,"isPrivate":false,"settingStoreCookies":true,"settingSendCookies":true,"settingDisableRenderRequestBody":false,"settingEncodeUrl":true,"settingRebuildPath":true,"settingFollowRedirects":"global","_type":"request"},{"_id":"req_55de006c201a491394db07f9e563ea53","parentId":"fld_b37d062da9574c5cac7465396b604d43","modified":1705007755023,"created":1705005314513,"url":"http://localhost/api/v1/expenditure/1","name":"Expenditure Show","description":"","method":"GET","body":{},"parameters":[],"headers":[{"id":"pair_dc2f4e9e8828439a90cdf1e7982ca489","name":"Authorization","value":"Bearer {% response 'body', 'req_60af1542c9f74e0b9faf3d9fcac7a0ba', 'b64::JC50b2tlbg==::46b', 'never', 60 %}","description":"","disabled":false}],"authentication":{},"metaSortKey":-1704991652833.25,"isPrivate":false,"settingStoreCookies":true,"settingSendCookies":true,"settingDisableRenderRequestBody":false,"settingEncodeUrl":true,"settingRebuildPath":true,"settingFollowRedirects":"global","_type":"request"},{"_id":"req_60af1542c9f74e0b9faf3d9fcac7a0ba","parentId":"fld_73431ae45b064bc9bd35d500182bd96f","modified":1705260218213,"created":1704988595208,"url":"http://localhost/api/v1/login","name":"Login","description":"","method":"POST","body":{"mimeType":"application/json","text":"{\n\t\"email\": \"fulano@gmail.com\",\n\t\"password\": \"123456\"\n}"},"parameters":[],"headers":[{"name":"Content-Type","value":"application/json"}],"authentication":{},"metaSortKey":-1704988595189.25,"isPrivate":false,"settingStoreCookies":true,"settingSendCookies":true,"settingDisableRenderRequestBody":false,"settingEncodeUrl":true,"settingRebuildPath":true,"settingFollowRedirects":"global","_type":"request"},{"_id":"fld_73431ae45b064bc9bd35d500182bd96f","parentId":"fld_63f5f01b14514477b604416f54e728b9","modified":1705260213001,"created":1705260206272,"name":"Auth","description":"","environment":{},"environmentPropertyOrder":null,"metaSortKey":-1704988595195.5,"_type":"request_group"},{"_id":"fld_63f5f01b14514477b604416f54e728b9","parentId":"wrk_dbede056adbd48ffa59b70518a592713","modified":1705000757055,"created":1705000757055,"name":"User","description":"","environment":{},"environmentPropertyOrder":null,"metaSortKey":-1705000757055,"_type":"request_group"},{"_id":"req_df66f04898c24654bde9844ecdbf49e6","parentId":"fld_73431ae45b064bc9bd35d500182bd96f","modified":1705260220845,"created":1704985545804,"url":"http://localhost/api/v1/logout","name":"Logout","description":"","method":"GET","body":{},"parameters":[],"headers":[{"id":"pair_8444dcabfdf643d5bd28b195d111a55c","name":"Authorization","value":"Bearer {% response 'body', 'req_60af1542c9f74e0b9faf3d9fcac7a0ba', 'b64::JC50b2tlbg==::46b', 'never', 60 %}","description":""}],"authentication":{},"metaSortKey":-1704988595139.25,"isPrivate":false,"settingStoreCookies":true,"settingSendCookies":true,"settingDisableRenderRequestBody":false,"settingEncodeUrl":true,"settingRebuildPath":true,"settingFollowRedirects":"global","_type":"request"},{"_id":"req_34d7193e043f4d00aa0f9bbd5a987911","parentId":"fld_63f5f01b14514477b604416f54e728b9","modified":1705260233887,"created":1704986382138,"url":"http://localhost/api/v1/user","name":"User List","description":"","method":"GET","body":{},"parameters":[],"headers":[],"authentication":{},"metaSortKey":-1704988595158,"isPrivate":false,"settingStoreCookies":true,"settingSendCookies":true,"settingDisableRenderRequestBody":false,"settingEncodeUrl":true,"settingRebuildPath":true,"settingFollowRedirects":"global","_type":"request"},{"_id":"req_26ecca8f0339406aa004812e1ec17727","parentId":"fld_63f5f01b14514477b604416f54e728b9","modified":1705207034808,"created":1705060899834,"url":"http://localhost/api/v1/user","name":"User Create","description":"","method":"POST","body":{"mimeType":"application/json","text":"{\n\t\"name\" : \"Fulano de taeal\",\n\t\"email\": \"fulanaawo@gmail.com\",\n\t\"password\": \"123456\"\n}"},"parameters":[],"headers":[{"name":"Content-Type","value":"application/json"}],"authentication":{},"metaSortKey":-1704988595133,"isPrivate":false,"settingStoreCookies":true,"settingSendCookies":true,"settingDisableRenderRequestBody":false,"settingEncodeUrl":true,"settingRebuildPath":true,"settingFollowRedirects":"global","_type":"request"},{"_id":"env_3ad428bc204eaf98cea189453d6641a13a2e30a8","parentId":"wrk_dbede056adbd48ffa59b70518a592713","modified":1704985542439,"created":1704985542439,"name":"Base Environment","data":{},"dataPropertyOrder":null,"color":null,"isPrivate":false,"metaSortKey":1704985542439,"_type":"environment"},{"_id":"jar_3ad428bc204eaf98cea189453d6641a13a2e30a8","parentId":"wrk_dbede056adbd48ffa59b70518a592713","modified":1704985542442,"created":1704985542442,"name":"Default Jar","cookies":[],"_type":"cookie_jar"}]}oading onfly_despesas…]()


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
