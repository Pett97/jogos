# Apresentação

Bem-vindo ao mini-projeto **Jogos**!

O objetivo deste projeto é aprender a utilizar o framework **Laravel** com o **Laravel Sail** para executar o projeto em um ambiente Docker.

Saiba mais sobre o Laravel Sail: [Documentação Oficial](https://laravel.com/docs/11.x/sail)

---

## Como Rodar o Projeto

### Requisitos:
- **Docker** instalado
- **Composer** instalado
- Nenhum processo ativo na porta 80 (como o Apache, por exemplo)

### Passo a Passo:

1. **Clonar o Repositório:**
   Abra o terminal e execute:
   ```bash
   git clone https://github.com/Pett97/jogos.git
   ```

2. **Acessar a Pasta do Projeto:**
   ```bash
   cd jogos
   ```

3. **Instalar Dependências PHP:**
   ```bash
   composer install
   ```
   **Atenção:** Certifique-se de que nenhum processo esteja usando a porta 80 no host.

4. **Instalar Dependências do Node.js:**
   ```bash
   npm install
   ```

5. **Subir o Ambiente Docker:**
   Execute o comando:
   ```bash
   ./vendor/bin/sail up
   ```

6. **Compilar os Assets Frontend:**
   Em outro terminal, execute:
   ```bash
   npm run dev
   ```

7. **Executar as Migrations:**
   ```bash
   ./vendor/bin/sail artisan migrate
   ```

8. **Executar os Seeders:**
   ```bash
   ./vendor/bin/sail artisan db:seed
   ```

9. **Executar os Testes:**
   ```bash
   ./vendor/bin/sail test
   ```

10. **Acessar o Projeto no Navegador:**
    Abra o navegador e acesse **localhost**.

---

## Endpoints da API

### Gêneros
- **Criar um Gênero:**
  ```
  POST localhost/api/generos/create
  ```
- **Deletar um Gênero:**
  ```
  DELETE localhost/api/generos/delete/{id}
  ```
- **Obter um Gênero:**
  ```
  GET localhost/api/generos/get/{id}
  ```
- **Listar todos os Gêneros:**
  ```
  GET localhost/api/generos/list
  ```
- **Atualizar um Gênero:**
  ```
  PUT localhost/api/generos/update/{id}
  ```

### Jogos
- **Criar um Jogo:**
  ```
  POST localhost/api/jogos/create
  ```
- **Deletar um Jogo:**
  ```
  DELETE localhost/api/jogos/delete/{id}
  ```
- **Obter um Jogo:**
  ```
  GET localhost/api/jogos/get/{id}
  ```
- **Listar todos os Jogos:**
  ```
  GET localhost/api/jogos/list
  ```
- **Atualizar um Jogo:**
  ```
  PUT localhost/api/jogos/update/{id}
  ```

### Usuários
- **Criar um Usuário:**
  ```
  POST localhost/api/user/create
  ```
- **Login do Usuário:**
  ```
  POST localhost/api/user/login
  ```
- **Logout do Usuário:**
  ```
  POST localhost/api/user/logout
  ```

---

### Observações:
- Caso encontre problemas, certifique-se de que todos os passos acima foram seguidos corretamente.
- Consulte a documentação oficial do Laravel e do Laravel Sail para solução de problemas.

---

**Divirta-se explorando o projeto Jogos!**

