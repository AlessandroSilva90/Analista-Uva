<h1>Prova Analista de Sistemas 1 - Uva </h1>

## Tecnologias Utilizadas:


- PHP v8.1.10
- Laravel v10.48.22 
- ReactJs
- Vite 5.4.8
- Node v18.8V.0
- React 18.3.1
- Boootstvrap v5.3.3
- Jquery 3.6.0
- Git
- Postgree

## Programas Utilizados
- VS Code
- Laragon
- PgAdmin 4
 

## Instruções de execução

Todo o sistema foi construido  utilizando o [Laragon](https://laragon.org/download/) pois ele ja possui todo o necessário para a criação do sistema(Git, php, apache, node etc) . Faça o download para ter o mesmo ambiente que utilizei;
- Realize também o download do pgAdmin para o gerenciamento do banco de dados [PgAdmin 4](https://www.pgadmin.org/download/pgadmin-4-windows/)

1- Após realiza o download das aplicações, abra o Laragon e PgAdmin.
   
    1.1 No PgAdmin crie o  banco de dados sistema_vendas;
    1.2 No Laragon inicie o Apache;

2- Apos isso, ainda no Laragon abra o terminal. Você estará no diretório www;
 
 2.1 Nesse diretório copie ou faça clone dos sistemas(Laravel e da API) para esse diretorio;

3- Apos os sistemas estarem na pasta www, entre na pasta do sistema laravel( cd Analista-Uva-main, se estiver com esse nome).

4- Dentro do diretorio do sistema execute o comando composer install para que o laravel instale todas as dependencias necessárias.

5- Após as dependencias instaladas crie o arquivo .env, em seguida copie e cole todo o código de .env.example.

6- Inicie o servidor laravel com php artisan serve.

7-  Execute as seeds e migrations para popular o banco de dados.

6- Depois de todos esses passos você poderá realizar os testes no sistema.



## Adições

Para o envio de email utilizei a plataforma [mailtrap](https://mailtrap.io/home) que fornece o servidor SMTP para a rralização dos testes de envio de email com queue.
No meu arquivo .env e no .envexample estão as minhas credenciais, então se possivel crie uma conta para poder realizar o teste ou utilize um servidor smtp real;

Se criado conta no mailtrap copie as informações do servidor smtp e substitua no arquivo .env as seguintes informações:

    MAIL_MAILER=smtp
    MAIL_HOST=sandbox.smtp.mailtrap.io
    MAIL_PORT=2525
    MAIL_USERNAME=06eaf130c506e8
    MAIL_PASSWORD=21469dce929528

* A senha(password) tem que esta como no exemplo acima, se estiver  MAIL_PASSWORD=***********528 o sistema de envio não irá funcionar, então copie as credencias do seu mailtrap com a opção COPY presente na plataforma.

* Caminho para as credenciais: Estar logado na conta mailtrap -> Email Testing -> Inboxes -> Integration -> Aqui você irá altera o Code Sample cUrl para Laravel 9+. Só copiar e fazer os procedimentos ja ditos.

