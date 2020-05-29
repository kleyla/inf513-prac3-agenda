CREATE DATABASE agenda DEFAULT CHARACTER  SET utf8;
USE agenda;
CREATE TABLE amigo (
  amig_ci int PRIMARY KEY,
  amig_nombre char(150) NOT NULL,
  amig_appm char(150) NOT NULL,
  amig_telf char(17) NOT NULL,
  amig_cel char(150) NOT NULL,
  amig_dir char(150) NOT NULL,
  amig_fnac char(150) NOT NULL,
  amig_foto char(150) NULL
);
CREATE TABLE propietario (
  prop_user char(150) PRIMARY KEY,
  prop_passwd char(150) NOT NULL,
  amig_ci int REFERENCES amigo
);
INSERT INTO amigo
VALUES
  (
    3924689,
    'Evans',
    'Balcazar Veizaga',
    '3952-2310',
    '710-76685',
    'Av. Humberto S. R. #220',
    '29/08/1975',
    'profile.png'
  );
INSERT INTO amigo
VALUES
  (
    4012065,
    'Jose Manuel',
    'Colque Paulasanz',
    '3952-2310',
    '710-99465',
    'Av. 1ro de Mayo #1520',
    '14/05/1975',
    'profile.png'
  );
INSERT INTO propietario
VALUES
  ('evans', '12345', 3924689);