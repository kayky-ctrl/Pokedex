# 🔴 Pokedéx Manager

Bem-vindo ao **Pokedéx Manager**! Uma aplicação web Full-Stack desenvolvida para gerenciar, catalogar e visualizar Pokémons. Este projeto permite que treinadores se cadastrem, façam login e interajam com uma base de dados de Pokémons, incluindo funcionalidades de criação e consulta detalhada.

## 📸 Visão Geral

O projeto é dividido em uma API robusta em Laravel e um Frontend moderno e responsivo utilizando Bootstrap 5 e JavaScript Puro (Vanilla JS).

### Principais Funcionalidades

* **Autenticação de Treinadores:**
    * Sistema de Cadastro (Sign Up) e Login (Sign In) seguros.
    * Autenticação via Token (Laravel Sanctum).
* **Gestão de Pokémons:**
    * **Dashboard:** Listagem paginada de todos os Pokémons cadastrados.
    * **Consulta:** Busca detalhada por ID, visualizando imagem, tipos, status base (HP, Atk, Def, etc.) e perfil físico.
    * **Cadastro/Edição:** Formulário completo para registrar novos Pokémons ou atualizar existentes, incluindo upload de URL de imagem e definição de atributos.
* **Perfil do Treinador:**
    * Visualização dos dados do usuário logado (insígnias, time atual e estatísticas).

---

## 🚀 Tecnologias Utilizadas

### Backend (API)
* **PHP 8.x**
* **Laravel Framework**
* **MySQL** (Banco de Dados)
* **Laravel Sanctum** (Autenticação via API Token)

### Frontend (Interface)
* **HTML5 & CSS3**
* **JavaScript (ES6+)** - Consumo de API via `fetch`.
* **Bootstrap 5.3** - Estilização responsiva.
* **FontAwesome 6.4** - Ícones.

---

## ⚙️ Pré-requisitos

Certifique-se de ter instalado em sua máquina:
* [PHP](https://www.php.net/downloads) (versão 8.1 ou superior)
* [Composer](https://getcomposer.org/)
* [MySQL](https://www.mysql.com/)
* [Node.js](https://nodejs.org/) (Opcional, caso use live-server)

---

## 🔧 Como Executar o Projeto

### Passo 1: Configuração do Backend (Laravel)

1.  **Clone o repositório e acesse a pasta da API:**
    ```bash
    git clone [https://github.com/seu-usuario/pokedex-manager.git](https://github.com/seu-usuario/pokedex-manager.git)
    cd pokedex-manager/backend
    ```

2.  **Instale as dependências do PHP:**
    ```bash
    composer install
    ```

3.  **Configure o ambiente:**
    * Duplique o arquivo `.env.example` e renomeie para `.env`.
    * Configure as credenciais do seu banco de dados MySQL no arquivo `.env`:
    ```env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=pokedex_db
    DB_USERNAME=root
    DB_PASSWORD=sua_senha
    ```

4.  **Gere a chave da aplicação:**
    ```bash
    php artisan key:generate
    ```

5.  **Execute as Migrations:**
    * Crie o banco de dados `pokedex_db` no seu MySQL.
    * Rode o comando para criar as tabelas (`trainers`, `pokemon`, `types`, etc.):
    ```bash
    php artisan migrate
    ```

6.  **Inicie o Servidor:**
    ```bash
    php artisan serve
    ```
    * O backend estará rodando em: `http://localhost:8000`

---

### Passo 2: Configuração do Frontend

Como o frontend é feito em HTML/JS puro, você não precisa de `npm install` para rodá-lo, mas precisa servir os arquivos para evitar bloqueios de CORS.

1.  **Crie um arquivo de configuração JS (Recomendado):**
    * Crie uma pasta `js` e um arquivo `api.js` para centralizar a URL da API e o Token (conforme guia de implementação).

2.  **Execute o Frontend:**
    * Utilize a extensão **Live Server** do VS Code ou rode um servidor simples http:
    ```bash
    npx http-server .
    ```
    * Abra o navegador em `http://127.0.0.1:8080` (ou a porta indicada).

⚠️ **Atenção ao CORS:** Certifique-se de que o arquivo `config/cors.php` do Laravel esteja configurado para aceitar requisições da porta onde seu frontend está rodando.

---

## 📡 Documentação da API (Endpoints)

Aqui estão as rotas principais definidas nos Controllers:

### Autenticação
| Método | Endpoint | Descrição |
| :--- | :--- | :--- |
| `POST` | `/api/register` | Cria um novo treinador. |
| `POST` | `/api/login` | Autentica e retorna o Token Bearer. |
| `POST` | `/api/logout` | Encerra a sessão (Requer Token). |
| `GET` | `/api/user` | Retorna dados do treinador logado (Requer Token). |

### Pokémons
| Método | Endpoint | Descrição |
| :--- | :--- | :--- |
| `GET` | `/api/pokemons` | Lista Pokémons com paginação. |
| `POST` | `/api/pokemon/view` | Exibe detalhes de um Pokémon (Body: `{ "id": 1 }`). |
| `POST` | `/api/pokemon/save` | Cria ou Atualiza um Pokémon. |

---

## 📂 Estrutura de Pastas Importantes

```text
/
├── app/
│   ├── Http/Controllers/
│   │   ├── AuthController.php    # Lógica de Login/Registro
│   │   └── PokemonController.php # Lógica de Listagem/Visualização
│   └── Models/
│       ├── Pokemon.php           # Modelo e Casts (JSON)
│       └── Trainer.php           # Modelo do Usuário
├── public/                       # Arquivos Frontend
│   ├── index.html                # Tela de Login
│   ├── dashboard.html            # Tela Principal
│   ├── viewPokemon.html          # Detalhes do Pokémon
│   └── ...
└── routes/
    └── api.php                   # Definição das Rotas
```

## 🤝 Contribuição

Contribuições são bem-vindas! Sinta-se à vontade para abrir issues ou enviar pull requests para melhorar a Pokedéx.

## 📝 Licença

Este projeto está sob a licença MIT.

---
© 2025 Desenvolvido por [Kayky-ctrl]
