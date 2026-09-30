# INFILME
**Arthur Teixeira Soares e Bernardo Silva Gomes**

# Descrição do sistema
O INFILME é um sistema web de aluguel de filmes. O objetivo é oferecer ao cliente uma vitrine online onde ele pode conhecer os filmes disponíveis, escolher os que deseja, montar um carrinho e finalizar o aluguel, recebendo um número de protocolo como comprovante.
O que o sistema permite realizar
- Consultar o catálogo de filmes, com imagem, descrição, gênero e preço.
- Cadastrar-se e acessar o sistema com usuário e senha.
- Adicionar filmes ao carrinho, controlar a quantidade e remover itens.
- Finalizar a compra escolhendo a forma de pagamento e obter o protocolo.

# Principais funcionalidades
- Vitrine de filmes: os filmes são carregados do banco de dados, sem precisar alterar o código para incluir ou mudar um produto.
- Cadastro e login: os dados pessoais (nome, CPF e CEP) ficam separados dos dados de acesso (usuário e senha criptografada).
- Carrinho de compras: cada usuário tem seu carrinho salvo no banco, com a quantidade de cada filme. O preço não é repetido no carrinho, pois é lido da tabela de produtos.
- Finalização da compra: registra a venda, seus itens, a forma de pagamento (cartão de crédito, PIX ou boleto), o total e o protocolo.

# Informações que precisam ser armazenadas
- usuarios:
Código, nome completo, CPF (único) e CEP do cliente.
- login_usuario:
Código do usuário, nome de usuário (único) e senha em md5. Não guarda CPF.
- generos:
Código e nome do gênero (Ação, Animação, Comédia, Crime, Ficção Científica).
- produtos:
Código, nome, preço, descrição, imagem e gênero do filme.
- carrinho:
Código, usuário, filme e quantidade. Não guarda preço.
- vendas:
Protocolo, usuário, data e hora, forma de pagamento e total da compra.
- itens_venda:
Protocolo da venda, filme, quantidade e preço cobrado na data da compra.


**Modelo Entidade Relacionamento:**

![MER](ModeloER.png)


**Modelo Lógico:**

![MER](ML.png)


**SQL para criação do banco de dados:**

    CREATE DATABASE infilme;
    
    USE infilme;
    
    CREATE TABLE usuarios (
        Id INT AUTO_INCREMENT PRIMARY KEY,
        Nome VARCHAR(100) NOT NULL,
        cpf VARCHAR(11) NOT NULL UNIQUE,
        cep VARCHAR(8) NOT NULL
    );
    
    CREATE TABLE login_usuario (
        Id INT AUTO_INCREMENT PRIMARY KEY,
        usuario_id INT NOT NULL,
        conta VARCHAR(100) NOT NULL UNIQUE,
        senha VARCHAR(32) NOT NULL,
    
        CONSTRAINT fk_login_usuario
        FOREIGN KEY (usuario_id)
        REFERENCES usuarios(Id)
    );
    
    CREATE TABLE vendas (
        protocolo INT AUTO_INCREMENT PRIMARY KEY,
        usuario_id INT NOT NULL,
        nome_usuario VARCHAR(100) NOT NULL,
        compras TEXT NOT NULL,
        valor_final DECIMAL(10,2) NOT NULL,
        pagamento VARCHAR(50) NOT NULL,
    
        CONSTRAINT fk_vendas_usuario
        FOREIGN KEY (usuario_id)
        REFERENCES usuarios(Id)
    );
