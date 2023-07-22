<div align="center">
    <p>
        <a href="https://github.com/thiiagoms/opinion-box">
          <img src="resources/img/opinionbox.png" alt="Logo">
        </a>
        <h3 align="center">Teste - OpinionBox :brazil:</h3>
    </p>
    <br>
    <p float="left">
        <img src="https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white"
            alt="php" width="70"
        >
    </p>
</div>

- [Dependências :package:](#dependências)
- [Instalação :package:](#instalação)
- [Uso :runner:](#uso)
- [Bonus :medal_sports:](#bonus)

## Dependências

- PHP8.1+
- MySQL
- Git
- Composer

## Instalação

01 -) Clone o repositório:

```bash
$ git clone https://github.com/thiiagoms/opinion-box
```

02 -) Vá para o diretório do projeto:

```bash
$ cd opinion-box
opinion-box $
```

03 -) Faça uma cópia do arquivo `.env.example` para `.env` e adiciona as credenciais do seu banco de dados:
```bash
opinion-box $ cp .env.example .env
opinion-box $ vim .env

DATABASE_HOST=
DATABASE_PORT=
DATABASE_NAME=
DATABASE_USER=
DATABASE_PASS=
```

04 -) Importe o banco de dados localizado em `infra/database.sql` para seu servidor.

## Uso

01 -) Execute a aplicação através do servidor nativo do PHP:
```bash
opinion-box $ php -S localhost:80000
```

02 -) Vá até o link da aplicação `http://localhost:8000`
