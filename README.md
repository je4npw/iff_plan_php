# Sistema de Gestão para Serviço de Saúde em Residencial Terapêutico

## Descrição

Este projeto é um sistema de gestão desenvolvido para auxiliar na administração de serviços de saúde em residenciais terapêuticos. O objetivo é fornecer uma plataforma que facilite o gerenciamento de informações, atendimentos e dados dos acolhidos, promovendo uma melhor organização e eficiência no atendimento.

## Tecnologias Utilizadas

- **Laravel**: Framework PHP utilizado para o desenvolvimento do sistema.
- **MySQL**: Banco de dados relacional utilizado para armazenar as informações do sistema.

## Funcionalidades

- Cadastro e gerenciamento de acolhidos
- Registro de atendimentos
- Controle de dados de saúde
- Geração de relatórios
- Autenticação de usuários e gerenciamento de permissões

## Pré-requisitos

Antes de iniciar, certifique-se de ter as seguintes ferramentas instaladas em sua máquina:

- PHP >= 8.0
- Composer
- MySQL

## Instalação

Siga os passos abaixo para configurar o projeto em sua máquina local:

1. Clone o repositório:
   ```bash
   git clone https://github.com/je4npw/iff_plan_php.git
   cd iff_plan_php
   ```

2. Instale as dependências do projeto:
   ```bash
   composer install
   ```

3. Renomeie o arquivo `.env.example` para `.env` e configure as credenciais do banco de dados.

4. Gere a chave de aplicação:
   ```bash
   php artisan key:generate
   ```

5. Execute as migrações para criar as tabelas no banco de dados:
   ```bash
   php artisan migrate
   ```

6. Inicie o servidor de desenvolvimento:
   ```bash
   php artisan serve
   ```

7. Acesse a aplicação pelo navegador em `http://localhost:8000`.

## Contribuição

Contribuições são bem-vindas! Sinta-se à vontade para abrir uma issue ou um pull request para discutir melhorias ou correções.

## Licença

Este projeto está licenciado sob a [MIT License](LICENSE).

## Contato

Para mais informações, entre em contato:

- Nome: Jean Patrick Wilhvock
- Email: je4n.pw@gmail.com | contato@redesalomao.com.br
