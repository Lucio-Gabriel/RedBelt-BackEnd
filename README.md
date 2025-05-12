
# Sistema de Alarmes de Segurança

O Sistema de Alarmes de Segurança é um projeto desenvolvido como parte de um teste técnico para a empresa Redbelt. Seu objetivo é permitir que analistas SOC possam cadastrar, listar e gerenciar alarmes de incidentes de segurança, possibilitando uma reação rápida a novos eventos.


## Stack utilizada

**Front-end:** React, Redux, TailwindCSS

**Back-end:** PHP, Laravel, MySQL, PHPUnit


## Funcionalidades

- CRUD completo de alarmes
- Testes unitários com 100% de cobertura
- API RESTful com validações e regras de negócio


## Instalação e Execução

Clone este repositório:

```bash
  git clone https://github.com/SeuUsuario/RedBelt-BackEnd.git
```

Configure seu .env:

```bash
  cp .env.example .env
```


Execute as migrations:

```bash
  php artisan migrate
```
Execute os seeders:

```bash
  php artisan db:seed
```

Execute os testes:

```bash
  php artisan test

```

Acesse o sistema:

```bash
  http://localhost

```



## Observações

* Todo o código foi estruturado com foco em boas práticas e legibilidade

* Organização de pastas segue o padrão MVC do Laravel

