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
        <img
            src="https://img.shields.io/badge/docker-%230db7ed.svg?style=for-the-badge&logo=docker&logoColor=white"
            alt="Docker"
        >
    </p>
</div>

- [Dependências :package:](#dependências)
- [Instalação :package:](#instalação)
- [Uso :runner:](#uso)
- [Bonus :medal_sports:](#bonus)

## Dependências

- Docker :whale:

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

03 -) Faça uma cópia do arquivo `.env.example` para `.env`:
```bash
opinion-box $ cp .env.example .env
```

04 -) Faça o **up** dos containers:
```bash
opinion-box $ docker-compose up -d
```

05 -) instale as dependências do projeto utilizando o composer:
```bash
opinion-box $ composer install
```

## Uso

01 -) Vá até o link da aplicação `http://localhost:8000`

## Bonus

01 -) Para executar o lint (`phpcs`) e seu fix (`phpcbf`) na aplicação:
```bash
opinion-box $ docker exec opinionbox-app composer phpcs src
opinion-box $ docker exec opinionbox-app composer phpcbf src
```