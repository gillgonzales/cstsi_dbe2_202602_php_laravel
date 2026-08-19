# Exemplos da Disciplina de Desenvolvimento Backend II - CSTSI

Este repositório contém projetos de exemplo desenvolvidos durante as aulas da disciplina de Desenvolvimento Backend II do 4º Semestre do Curso Superior de Tecnologia em Sistemas para Internet do IFSUL.

---

**Autor**: Prof. Gonzales  
**Email**: gillgonzales@ifsul.edu.br

---

## 📋 Visão Geral - Tópico 01

No **Tópico 01** desenvolvemos um projeto web em PHP puro, moderno, de acordo com o paradigma da Orientação a Objetos e com uma arquitetura baseada em MVC (Model-View-Controller). Utiliza Docker e Docker Compose para conteinerização e gerenciamento de serviços, facilitando o desenvolvimento e a padronização do ambiente.

[Link Material](https://docs.google.com/presentation/d/e/2PACX-1vS3EH4HhxQAPW91I5QwX5wySod-I7CGEZbA9vP86912O62n5_K-g8rcRe7nr7WrF8OvoLaYb6rn8_9G/pub?start=false&loop=false&delayms=3000&slide=id.p1)

---

## 📝 Variáveis de Ambiente

Crie um arquivo `.env` na raiz do projeto e altere os valores da variáveis de ambiente:

```env
APP_PORT=8000
FORWARD_DB_PORT=3308
FORWARD_MYADMIN_PORT=8091

DB_DRIVER=mariadb
DB_USER=root
DB_PASS=r00t
DB_NAME=php_app
```

---

## 🐳 Docker e Docker Compose

### O que é Docker?

Docker é uma plataforma de containerização que encapsula a aplicação e suas dependências em um container isolado, garantindo que o código funcione consistentemente em diferentes ambientes.

### Componentes do Docker Compose

O arquivo `compose.yaml` define três serviços principais:

#### 1. **app_php** - Serviço da Aplicação PHP
- **Imagem Base**: PHP 8.5.9 em Alpine Linux
- **Porta**: Acessível em `http://localhost:8000` (configurável via `APP_PORT`)
- **Volume**: Monta o diretório local em `/var/www/html` para sincronização de arquivos
- **Comando Inicial**:
  - Acessa o diretório de trabalho
  - Executa `composer install` para instalar dependências
  - Inicia o servidor built-in do PHP no port 80

#### 2. **app_db** - Banco de Dados
- **Imagem**: MariaDB (última versão)
- **Porta**: 3306 (configurável via `FORWARD_DB_PORT`)
- **Variáveis de Ambiente**:
  - `DB_PASS`: Senha do root e usuário
  - `DB_NAME`: Nome do banco de dados
  - `DB_USER`: Usuário do banco
- **Volume Persistente**: `vol_db` armazena dados do MySQL
- **Health Check**: Verifica a saúde do banco a cada 5 segundos

#### 3. **phpmyadmin** - Interface de Gerenciamento do Banco
- **Imagem**: PhpMyAdmin (última versão)
- **Porta**: 8091 (configurável via `FORWARD_MYADMIN_PORT`)
- **Funcionalidade**: Interface web para gerenciar o banco de dados
- **Acesso**: `http://localhost:8091`

### Rede e Volumes

- **Rede**: `app_net` (tipo bridge) conecta todos os serviços
- **Volume**: `vol_db` persiste dados do banco de dados entre reinicializações


## 🔧 Dockerfile - Construção da Imagem

O `Dockerfile` define como a imagem Docker é construída:

```dockerfile
FROM php:8.5.9-alpine
```
- Base: PHP 8.5.9 em Alpine Linux (leve e seguro)

### Instalação de Dependências
```dockerfile
RUN apk update && apk add --no-cache \
    libpq-dev \
    bash \
    curl \
    vim \
    unzip
```
- Instala ferramentas essenciais e suporte a PostgreSQL

### Extensões PHP
```dockerfile
RUN docker-php-ext-install pdo_mysql pdo_pgsql
```
- PDO MySQL: Suporte a banco de dados MariaDB/MySQL
- PDO PostgreSQL: Suporte a banco de dados PostgreSQL

### Composer
```dockerfile
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
```
- Copia Composer da imagem oficial para usar no container

### Configuração Final
```dockerfile
WORKDIR /var/www/html
COPY . .
EXPOSE $APP_PORT
```
- Define diretório de trabalho
- Copia arquivos da aplicação
- Expõe a porta configurada

---


## 🚀 Como Usar Docker Compose

### Pré-requisitos

- Docker instalado
- Docker Compose instalado
- Arquivo `.env` na raiz do projeto com as variáveis:
  ```env
  APP_PORT=8000
  DB_NAME=seu_banco
  DB_USER=seu_usuario
  DB_PASS=sua_senha
  FORWARD_DB_PORT=3306
  FORWARD_MYADMIN_PORT=8091
  ```

### Iniciar os Containers

```bash
# Iniciar em modo foreground (vê os logs)
docker compose up

# Iniciar em background (modo daemon)
docker compose up -d
```

### Parar os Containers

```bash
docker compose down
```

### Parar e Remover Volumes

```bash
docker compose down -v
```

### Visualizar Logs

```bash
# Todos os serviços
docker compose logs -f

# Serviço específico
docker compose logs -f app_php
docker compose logs -f app_db
```

### Executar Comandos no Container

```bash
# Acessar shell do PHP
docker compose exec app_php bash

# Executar comando específico
docker compose exec app_php php -v
```

---

## 🔄 Fluxo de Inicialização

1. **Docker Compose** inicia os containers
2. **Container PHP**:
   - Instala dependências via `composer install`
   - Executa `composer run dev` (inicia servidor)
3. **Container MariaDB**:
   - Inicializa banco de dados
   - Executa health checks
4. **Container PhpMyAdmin**: 
   - Conecta ao MariaDB
   - Disponibiliza interface web
5. **Aplicação**:
   - `src/index.php` carrega `App::init()`
   - `App` Carrega variáveis `.env` e executa a resolução de rotas `Router::resolve()`
   - Router processa rotas de acordo com requisições
   - As rotas seguem o padrão `controller/method/param` 
   - As rotas são configuradas em `src/config/routes.php`
   - Cada rota mapeia uma classe do tipo Controller `['produtos'=>ProdutoController::class]`
   - `Controllers` acessam dados via `Models` e redirecionam para `Views`

---

## 🌐 Acessando a Aplicação

Após iniciar com `docker compose up`:

- **Aplicação PHP**: http://localhost:8000
- **PhpMyAdmin**: http://localhost:8091
- **Banco de Dados**: localhost:3306
  - Usuário: definido em `.env`
  - Senha: definida em `.env`

---

## 🏗️ Arquitetura MVC

O projeto segue o padrão **Model-View-Controller**, onde:

### **Controller** (Intermediário)
- Responsável por processar requisições e orquestrar Model e View
- Localização: `src/controllers/`
- Exemplo: `ProdutoController.php` - Controla operações de Produtos
- Classe base: `Controller.php`

### Fluxo de Requisição

```
Requisição HTTP → App → Route → Controller → Model (BD) → View → Resposta
```

---

## 📦 Composer - Gerenciamento de Dependências

### O que é Composer?

Composer é o gerenciador de dependências do PHP, similar ao npm (Node.js) ou pip (Python).

### Arquivo `composer.json`

Define metadados e dependências do projeto:

```json
{
    "name": "cstsi/dbe2_202602_php_mvc",
    "type": "project",
    "require": {
        "vlucas/phpdotenv": "5.6.x-dev"  // Carrega variáveis .env
    },
    "require-dev": {
        "psy/psysh": "0.12.x-dev"  // Shell interativo PHP
    },
    "license": "GPL-3.0-only",
    "autoload": {
        "psr-4": {
            "CSTSI\\Dbe2\\": "src/"  // Autoload PSR-4
        }
    },
    "scripts": {
        "start": "php -S 0.0.0.0:80 -t src/public"  // Inicia servidor built-in
    },
    "config": { //Configuração de timeout, corrigi erro no container da app
        "process-timeout": 0
    }
}
```

### Dependências Principais

#### **vlucas/phpdotenv**
- Carrega variáveis de ambiente do arquivo `.env`
- Permite configuração segura de credenciais
- Inicializado em `src/core/App.php`

#### **psy/psysh**
- Shell interativo para PHP (REPL)
- Facilita debugging e testes rápidos

### Instruções Principais do Composer

#### Instalar Dependências
```bash
composer install
```
- Instala todas as dependências definidas em `composer.json`
- Cria/atualiza o arquivo `composer.lock`
- Executado automaticamente pelo Docker ao iniciar

#### Instalar Nova Dependência
```bash
composer require vendor/package
```

#### Instalar Dependência de Desenvolvimento
```bash
composer require --dev vendor/package
```

#### Atualizar Dependências
```bash
composer update
```
- Atualiza pacotes para versões mais recentes

#### Autload PSR-4
```php
require_once __DIR__.'/vendor/autoload.php';
```
- Fornecido automaticamente pelo Composer
- Permite que classes sejam carregadas automaticamente pelo namespace

#### Executar Scripts Personalizados
```bash
# Inicia servidor development
composer run start

# Acessa shell interativo
composer exec psysh
```

---


## ✅ Checklist de Inicialização

- [ ] Docker e Docker Compose instalados
- [ ] Arquivo `.env` criado com variáveis
- [ ] `docker compose up` executado
- [ ] Aplicação acessível em localhost:8000
- [ ] PhpMyAdmin acessível em localhost:8091
- [ ] Banco de dados funcionando (health check)
- [ ] Dependências instaladas (vendor/)

---

## 📚 Recursos Adicionais

- [Docker Documentation](https://docs.docker.com/)
- [Docker Compose Documentation](https://docs.docker.com/compose/)
- [PHP Official](https://www.php.net/)
- [Composer Documentation](https://getcomposer.org/doc/)
- [PSR-4 Autoloading](https://www.php-fig.org/psr/psr-4/)


