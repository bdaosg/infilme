CREATE DATABASE infilme;

USE infilme;

-- Tabela de usuários
CREATE TABLE usuarios (
    Id INT AUTO_INCREMENT PRIMARY KEY,
    Nome VARCHAR(100) NOT NULL,
    cpf VARCHAR(11) NOT NULL UNIQUE,
    cep VARCHAR(8) NOT NULL
);

-- Tabela de login
CREATE TABLE login_usuario (
    Id INT AUTO_INCREMENT PRIMARY KEY,
    conta VARCHAR(100) NOT NULL UNIQUE,
    senha VARCHAR(32) NOT NULL
);

-- Tabela de vendas
CREATE TABLE vendas (
    protocolo INT AUTO_INCREMENT PRIMARY KEY,
    nome_usuario VARCHAR(100) NOT NULL,
    compras TEXT NOT NULL,
    valor_final DECIMAL(10,2) NOT NULL,
    pagamento VARCHAR(50) NOT NULL
);
