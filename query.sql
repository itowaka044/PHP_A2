insert into cliente (nomeCliente,cpf,telefone) values ("nome teste", "12312312300", "41998765432");
______________________________________________________
insert into quadra(nomeQuadra,tipo,valorHora) values 
("quadra A", "society", 7000),
("quadra B", "futsal", 6000),
("quadra C", "areia", 10000);
__________________________________________________

INSERT INTO horarios_disponiveis (idQuadra, dataHorario, horaInicio, horaFim) VALUES (1, :data_horario, :hora_inicio, :hora_fim);

______________________________________________________
CREATE TABLE Cliente (
    idCliente INT AUTO_INCREMENT PRIMARY KEY,
    nomeCliente VARCHAR(100) NOT NULL,
    cpf VARCHAR(14) NOT NULL UNIQUE,
    telefone VARCHAR(20)
);

CREATE TABLE Quadra (
    idQuadra INT AUTO_INCREMENT PRIMARY KEY,
    nomeQuadra VARCHAR(100) NOT NULL,
    tipo VARCHAR(50),
    valorHora INT NOT NULL
);

CREATE TABLE Horario (
    idHorario INT AUTO_INCREMENT PRIMARY KEY,
    idQuadra INT NOT NULL,
    dataHorario DATE NOT NULL,
    horaInicio TIME NOT NULL,
    horaFim TIME NOT NULL,
    statusDisp BOOLEAN NOT NULL DEFAULT TRUE,
    FOREIGN KEY (idQuadra) REFERENCES Quadra(idQuadra)
);

CREATE TABLE Reserva (
    idReserva INT AUTO_INCREMENT PRIMARY KEY,
    idCliente INT NOT NULL,
    idHorario INT NOT NULL,
    idQuadra INT NOT NULL,
    dataReserva DATE NOT NULL,
    statusReserva BOOLEAN NOT NULL DEFAULT TRUE,
    FOREIGN KEY (idCliente) REFERENCES Cliente(idCliente),
    FOREIGN KEY (idHorario) REFERENCES Horario(idHorario),
    FOREIGN KEY (idQuadra) REFERENCES Quadra(idQuadra)
);

______________________________________________________

ALTER TABLE horario
ADD CONSTRAINT unico_horario_quadra_data_inicio
UNIQUE (idQuadra, dataHorario, horaInicio);