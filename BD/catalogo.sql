-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-03-2025 a las 00:06:25
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `catalogo`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id_categoria` int(11) NOT NULL,
  `nombre_categoria` varchar(100) NOT NULL,
  `imagen_categoria` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id_categoria`, `nombre_categoria`, `imagen_categoria`) VALUES
(1, 'Alzate', 'https://robohash.org/occaecatiquosenim.png?size=400x400&set=set1'),
(2, 'Neel', 'https://robohash.org/autimpeditconsequatur.png?size=400x400&set=set1'),
(3, 'Janek', 'https://robohash.org/laboreconsequunturlibero.png?size=400x400&set=set1'),
(4, 'Granthem', 'https://robohash.org/etvoluptasquis.png?size=400x400&set=set1'),
(5, 'Margette', 'https://robohash.org/cumconsequaturquos.png?size=400x400&set=set1'),
(6, 'Rhonda', 'https://robohash.org/utsuntpossimus.png?size=400x400&set=set1'),
(7, 'Constanta', 'https://robohash.org/atquevoluptatequas.png?size=400x400&set=set1'),
(8, 'Caldwell', 'https://robohash.org/cupiditatenesciuntmolestiae.png?size=400x400&set=set1'),
(9, 'Tana', 'https://robohash.org/illodoloribuset.png?size=400x400&set=set1'),
(10, 'Betteanne', 'https://robohash.org/quicumqueperferendis.png?size=400x400&set=set1'),
(11, 'Eldin', 'https://robohash.org/consequaturveroaut.png?size=400x400&set=set1'),
(12, 'Marketa', 'https://robohash.org/rerumcumqueculpa.png?size=400x400&set=set1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id_producto` int(11) NOT NULL,
  `nombre_producto` varchar(100) NOT NULL,
  `descripcion_producto` text DEFAULT NULL,
  `precio_producto` decimal(10,2) NOT NULL,
  `cantidad_producto` int(11) NOT NULL,
  `imagen_producto` varchar(255) DEFAULT NULL,
  `categoria_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id_producto`, `nombre_producto`, `descripcion_producto`, `precio_producto`, `cantidad_producto`, `imagen_producto`, `categoria_id`) VALUES
(1, 'Transcof', 'Term delivery w preterm labor, third trimester, unsp', 41122.00, 12, 'https://robohash.org/consequaturmaximemodi.png?size=400x400&set=set1', 8),
(2, 'Keylex', 'Minor lacerat great saphenous at hip and thi lev, left leg', 58693.00, 2, 'https://robohash.org/iureautemest.png?size=400x400&set=set1', 7),
(3, 'Voltsillam', 'Partial traumatic amputation of one lesser toe', 70099.00, 3, 'https://robohash.org/similiqueetcum.png?size=400x400&set=set1', 2),
(4, 'Asoka', 'Inj musc/tend peroneal grp at low leg level, left leg, init', 74415.00, 16, 'https://robohash.org/estharumvoluptate.png?size=400x400&set=set1', 2),
(5, 'Bigtax', 'Retinal micro-aneurysms, unspecified', 61781.00, 5, 'https://robohash.org/etteneturipsam.png?size=400x400&set=set1', 4),
(6, 'Temp', 'Unspecified fracture of unspecified metacarpal bone', 75661.00, 6, 'https://robohash.org/quasiiddolorem.png?size=400x400&set=set1', 6),
(7, 'Sonsing', 'Displaced fracture of left radial styloid process, sequela', 92963.00, 7, 'https://robohash.org/sediustomolestiae.png?size=400x400&set=set1', 6),
(8, 'Y-find', 'Displ intartic fx unsp calcaneus, subs for fx w delay heal', 47832.00, 29, 'https://robohash.org/animipraesentiumdolores.png?size=400x400&set=set1', 10),
(9, 'Hatity', 'Fx unsp prt of nk of unsp femr, 7thD', 40273.00, 9, 'https://robohash.org/voluptascorporisvoluptatem.png?size=400x400&set=set1', 12),
(10, 'Mat Lam Tam', 'Fibrous dysplasia (monostotic), thigh', 47869.00, 10, 'https://robohash.org/ducimusrepellatpariatur.png?size=400x400&set=set1', 4),
(11, 'Toughjoyfax', 'Cochlear otosclerosis', 18527.00, 11, 'https://robohash.org/aliquidtemporaquia.png?size=400x400&set=set1', 4),
(12, 'Tampflex', 'Form of external stoma cause abn react/compl, w/o misadvnt', 29026.00, 12, 'https://robohash.org/doloresdebitisassumenda.png?size=400x400&set=set1', 4),
(13, 'Bitwolf', 'Other superficial bite of vagina and vulva, subs encntr', 79551.00, 13, 'https://robohash.org/nonmolestiasinventore.png?size=400x400&set=set1', 2),
(14, 'Redhold', 'Other juvenile osteochondrosis, right upper limb', 30676.00, 14, 'https://robohash.org/velitpariaturpraesentium.png?size=400x400&set=set1', 7),
(15, 'Greenlam', 'Other bursitis of hip, left hip', 84727.00, 15, 'https://robohash.org/adeosa.png?size=400x400&set=set1', 8),
(16, 'Asoka', 'Injury of optic nerve, left eye', 51609.00, 16, 'https://robohash.org/solutaundesunt.png?size=400x400&set=set1', 1),
(17, 'Fix San', 'Hemangioma of other sites', 83865.00, 17, 'https://robohash.org/nisinihilmollitia.png?size=400x400&set=set1', 12),
(18, 'Lotstring', 'Drug use complicating pregnancy, first trimester', 74499.00, 18, 'https://robohash.org/consequunturetreprehenderit.png?size=400x400&set=set1', 3),
(19, 'Home Ing', 'Injury of cutaneous sensory nerve at hip and thigh level', 20900.00, 19, 'https://robohash.org/adnihilhic.png?size=400x400&set=set1', 2),
(20, 'Aerified', 'Other specified disorders of cartilage, unspecified sites', 51004.00, 20, 'https://robohash.org/doloremsaepebeatae.png?size=400x400&set=set1', 6),
(21, 'Pannier', 'Oth diabetes mellitus with diabetic neuropathic arthropathy', 92321.00, 21, 'https://robohash.org/quosrerumaut.png?size=400x400&set=set1', 7),
(22, 'Domainer', 'Benign neoplasm of left ureter', 28594.00, 22, 'https://robohash.org/sedatqueeum.png?size=400x400&set=set1', 8),
(23, 'Hatity', 'Disp fx of medial phalanx of other finger, sequela', 36005.00, 23, 'https://robohash.org/consecteturilloculpa.png?size=400x400&set=set1', 8),
(24, 'Fix San', 'Lateral subluxation and dislocation of patella', 84245.00, 24, 'https://robohash.org/adveniamreprehenderit.png?size=400x400&set=set1', 1),
(25, 'Daltfresh', 'Open bite of unspecified toe(s) without damage to nail', 33210.00, 25, 'https://robohash.org/consecteturnonsed.png?size=400x400&set=set1', 9),
(26, 'Konklux', 'Athscl autol vein bypass of extrm w rest pain, unsp extrm', 83314.00, 26, 'https://robohash.org/accusamusdelenitiaut.png?size=400x400&set=set1', 4),
(27, 'Biodex', 'Injury of unsp nerve at ankle and foot level, right leg', 36940.00, 27, 'https://robohash.org/nonvoluptascommodi.png?size=400x400&set=set1', 10),
(28, 'Mat Lam Tam', 'Path fx in oth disease, r shoulder, subs for fx w routn heal', 14760.00, 28, 'https://robohash.org/exercitationemcommodisunt.png?size=400x400&set=set1', 2),
(29, 'Aerified', 'Paralytic calcification and ossification of muscle, l up arm', 42979.00, 29, 'https://robohash.org/nobisvoluptatemexcepturi.png?size=400x400&set=set1', 5),
(30, 'Tin', 'Pnctr w fb of unsp great toe w damage to nail, subs', 70615.00, 30, 'https://robohash.org/temporaeaquenulla.png?size=400x400&set=set1', 7),
(31, 'Voyatouch', 'Laceration of superficial palmar arch of right hand, subs', 34139.00, 31, 'https://robohash.org/fugitdebitisvoluptatibus.png?size=400x400&set=set1', 6),
(32, 'Zaam-Dox', 'Lacerat musc/fasc/tend at shldr/up arm, right arm, subs', 38852.00, 32, 'https://robohash.org/doloresnemoeius.png?size=400x400&set=set1', 5),
(33, 'Trippledex', 'Unspecified injury of left elbow, subsequent encounter', 81844.00, 33, 'https://robohash.org/consequatursolutaqui.png?size=400x400&set=set1', 2),
(34, 'Sonair', 'Oth fx shaft of right ulna, subs for clos fx w nonunion', 12664.00, 34, 'https://robohash.org/expeditamagnirepellendus.png?size=400x400&set=set1', 3),
(35, 'Treeflex', 'Galeazzi\'s fx unsp radius, init for opn fx type 3A/B/C', 77787.00, 35, 'https://robohash.org/similiquesitvoluptatem.png?size=400x400&set=set1', 6),
(36, 'Keylex', 'Encounter for exam and observation following oth accident', 70945.00, 36, 'https://robohash.org/accusantiumomnisaut.png?size=400x400&set=set1', 10),
(37, 'Otcom', 'Atrophoderma of Pasini and Pierini', 21363.00, 37, 'https://robohash.org/etveniamnihil.png?size=400x400&set=set1', 3),
(38, 'Tres-Zap', 'Iliofemoral ligament sprain of left hip', 63983.00, 38, 'https://robohash.org/inporroatque.png?size=400x400&set=set1', 10),
(39, 'Latlux', 'Unsp inj msl/fasc/tnd post grp at thi lev, right thigh, init', 65825.00, 39, 'https://robohash.org/eumdelenitiet.png?size=400x400&set=set1', 10),
(40, 'Stringtough', 'Osteonecrosis due to drugs, unspecified shoulder', 37177.00, 40, 'https://robohash.org/quodisteest.png?size=400x400&set=set1', 3),
(41, 'Gembucket', 'Anterior subluxation of unspecified humerus, sequela', 68409.00, 41, 'https://robohash.org/cupiditateutcumque.png?size=400x400&set=set1', 7),
(42, 'Subin', 'Adverse effect of anticoag antag, vitamin K and oth coag', 40515.00, 42, 'https://robohash.org/sequitotamquam.png?size=400x400&set=set1', 11),
(43, 'Cardguard', 'Injury of nerve root of lumbar spine, subsequent encounter', 77349.00, 43, 'https://robohash.org/iureetconsequatur.png?size=400x400&set=set1', 11),
(44, 'Duobam', 'Athscl autol vein bypass of right leg w ulcer oth prt foot', 75201.00, 44, 'https://robohash.org/velabquo.png?size=400x400&set=set1', 11),
(45, 'Duobam', 'Other specified fracture of unspecified ischium', 43958.00, 45, 'https://robohash.org/adipisciabsit.png?size=400x400&set=set1', 8),
(46, 'Cardguard', 'Moderate laceration of unspecified part of pancreas', 74189.00, 46, 'https://robohash.org/nequeestqui.png?size=400x400&set=set1', 1),
(47, 'Sonair', 'Displ transverse fx shaft of r femr, 7thM', 49072.00, 47, 'https://robohash.org/laborefugaquia.png?size=400x400&set=set1', 7),
(48, 'Bamity', 'Displ commnt fx shaft of l tibia, init for opn fx type I/2', 12794.00, 48, 'https://robohash.org/utillumlaborum.png?size=400x400&set=set1', 6),
(49, 'Overhold', 'Toxic effect of carbon tetrachloride, undetermined', 86754.00, 49, 'https://robohash.org/recusandaeidpariatur.png?size=400x400&set=set1', 6),
(50, 'Gembucket', 'Abnormal findings on dx imaging of prt digestive tract', 25389.00, 50, 'https://robohash.org/quisuscipitdoloremque.png?size=400x400&set=set1', 5),
(89, 'Producto Prueba', 'Descripcion', 36682.00, 80, 'https://robohash.org/consequaturmaximemodi.png?size=400x400&set=set1', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nombre_usuario` varchar(50) NOT NULL,
  `apellido_usuario` varchar(50) NOT NULL,
  `usuario_usuario` varchar(50) NOT NULL,
  `password_usuario` varchar(255) NOT NULL,
  `estado_usuario` varchar(10) DEFAULT 'activo',
  `rol_usuario` tinyint(1) DEFAULT 2
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre_usuario`, `apellido_usuario`, `usuario_usuario`, `password_usuario`, `estado_usuario`, `rol_usuario`) VALUES
(1, 'd', 'd', 'd', '$2y$10$uIqNVATohK0iV3WVikJJj.Fm/WdyOeSq4VQ4BjPKL1ffaWbSjU6Fu', 'activo', 2),
(2, 'Gabriel', 'Meza', 'gabo', '$2y$10$rU5PLyzQ9Cg9YBxrK4byMuOXI3plObPviLIa9SXEB0W6g8rNkmlsy', 'activo', 1),
(3, 'Gabriel', 'ddd', 'ddd', '$2y$10$dSD4Nf63/zf9d.DgQK5EGu3cUMmawh8ojw2bZPNvVWh1in2XOGFx2', 'activo', 2),
(4, 'dddd', 'ddd', 'dddd', '$2y$10$4IcdLVP2VpOpB3TVXxUEHugLwheFHesMXQh2YFag20fU4cccOWVVq', 'activo', 2),
(5, 'w', 'w', 'w', '$2y$10$XQA4KUQA.I0LoB5Cu6BrBuQSHfmXmJdMYjZybchu7E18PcJFExu4q', 'activo', 2),
(6, 'Jero', 'Jero', 'Jero', '$2y$10$DsRmpFtHxK4CGXi1NiEGBORGaPkwHpMYjA0DCq8F/wI6v6/yDWzDu', 'activo', 2);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id_producto`),
  ADD KEY `categoria_id` (`categoria_id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `usuario_usuario` (`usuario_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id_categoria`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
