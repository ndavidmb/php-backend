
INSERT INTO `doctor` (`IdDoctor`, `NomDoctor`, `ApellDoctor`, `IdEspecialidad`) VALUES
(1, 'Juan', 'Díaz', 1),
(2, 'Juan', 'Díaz', 1),
(3, 'Felipe', 'Torres', 1),
(4, 'Enrique', 'Calderon', 1),
(5, 'Laura', 'Fernandez', 1),
(6, 'Luisa', 'Castellanos', 1),
(7, 'Ofelio', 'Restrepo', 1),
(8, 'Miller', 'Cardenales', 1);


INSERT INTO `especialidad` (`IdEspecialidad`, `Nombre`) VALUES
(1, 'neurologo');


INSERT INTO `perfil` (`IdPerfil`, `Nombre`) VALUES
(1, 'Admin'),
(2, 'Paciente'),
(3, 'Doctor');


INSERT INTO `usuario` (`IdUsuario`, `NomUsuario`, `Correo`, `Contra`, `IdPerfil`, `Token`) VALUES
(1, 'admin', 'admin@gmail.com', '123456', 1, 'YWRtaW5AZ21haWwuY29tIA==MTIzNDU2IA==MTAvMDEvMjE='),
(2, 'patient', 'patient@gmail.com', '123456', 2, NULL),
(3, 'doctor', 'doctor@gmail.com', '123456', 3, NULL),
(6, 'enriquess', 'gmail@gmail.com', '123456', 1, NULL);
