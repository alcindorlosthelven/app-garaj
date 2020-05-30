-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.10-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             11.0.0.5919
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping structure for table app-garaj.achat
DROP TABLE IF EXISTS `achat`;
CREATE TABLE IF NOT EXISTS `achat` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_fournisseur` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `statut` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_achat_fournisseur` (`id_fournisseur`),
  CONSTRAINT `FK_achat_fournisseur` FOREIGN KEY (`id_fournisseur`) REFERENCES `fournisseur` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- Dumping data for table app-garaj.achat: ~0 rows (approximately)
DELETE FROM `achat`;
/*!40000 ALTER TABLE `achat` DISABLE KEYS */;
INSERT INTO `achat` (`id`, `id_fournisseur`, `date`, `statut`) VALUES
	(7, 2, '2020-05-29', 'finaliser'),
	(8, 2, '2020-05-29', 'finaliser');
/*!40000 ALTER TABLE `achat` ENABLE KEYS */;

-- Dumping structure for table app-garaj.client
DROP TABLE IF EXISTS `client`;
CREATE TABLE IF NOT EXISTS `client` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `telephone` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `photo` text DEFAULT NULL,
  `date_naissance` varchar(50) DEFAULT NULL,
  `cin` varchar(50) DEFAULT NULL,
  `nif` varchar(50) DEFAULT NULL,
  `actif` enum('oui','non') NOT NULL,
  `pseudo` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `adresse` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- Dumping data for table app-garaj.client: ~0 rows (approximately)
DELETE FROM `client`;
/*!40000 ALTER TABLE `client` DISABLE KEYS */;
INSERT INTO `client` (`id`, `nom`, `prenom`, `telephone`, `email`, `photo`, `date_naissance`, `cin`, `nif`, `actif`, `pseudo`, `password`, `adresse`) VALUES
	(6, 'alcindor', 'losthelven', '(+509)3739-15-67', 'alcindorlos@gmail.com', 'app/DefaultApp/public/fichier/photo_alcindorlosthelven.png', '14/11/1993', '54-65-46-5465-46-54654', '646-546-546-5', 'non', 'lalcindor54', '63982e54a7aeb0d89910475ba6dbd3ca6dd4e5a1', '10 fontamara 29'),
	(7, 'thomas', 'farana', '(+509)4455-44-85', 'thomas@gmail.com', 'null', '12/11/1990', 'n/a', '546-546-546-5', 'non', 'fthomas94', '63982e54a7aeb0d89910475ba6dbd3ca6dd4e5a1', '10 fontamara 29');
/*!40000 ALTER TABLE `client` ENABLE KEYS */;

-- Dumping structure for table app-garaj.configuration
DROP TABLE IF EXISTS `configuration`;
CREATE TABLE IF NOT EXISTS `configuration` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) DEFAULT NULL,
  `valeur` text DEFAULT NULL,
  `categorie` enum('image','text','video','non_modifiable') DEFAULT 'image',
  PRIMARY KEY (`id`),
  UNIQUE KEY `nom` (`nom`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Dumping data for table app-garaj.configuration: 4 rows
DELETE FROM `configuration`;
/*!40000 ALTER TABLE `configuration` DISABLE KEYS */;
INSERT INTO `configuration` (`id`, `nom`, `valeur`, `categorie`) VALUES
	(1, 'licence_email', 'los-framework@gmail.com', 'non_modifiable'),
	(2, 'licence_code', '53-240-936-26', 'non_modifiable'),
	(3, 'licence_url', 'http://licence-serveur-sge.bioshaiti.com/licence-serveur-sge', 'text'),
	(4, 'taxe', '5.6', 'text');
/*!40000 ALTER TABLE `configuration` ENABLE KEYS */;

-- Dumping structure for table app-garaj.conjointe_employer
DROP TABLE IF EXISTS `conjointe_employer`;
CREATE TABLE IF NOT EXISTS `conjointe_employer` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `id_employer` int(11) DEFAULT NULL,
  `nom` varchar(50) DEFAULT NULL,
  `prenom` varchar(50) DEFAULT NULL,
  `relation` varchar(50) DEFAULT NULL,
  `telephone` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_conjoint_employer_employer` (`id_employer`),
  CONSTRAINT `FK_conjoint_employer_employer` FOREIGN KEY (`id_employer`) REFERENCES `employer` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table app-garaj.conjointe_employer: ~0 rows (approximately)
DELETE FROM `conjointe_employer`;
/*!40000 ALTER TABLE `conjointe_employer` DISABLE KEYS */;
INSERT INTO `conjointe_employer` (`id`, `id_employer`, `nom`, `prenom`, `relation`, `telephone`) VALUES
	(3, 9, 'jhjkhjkh', 'jhjkhkjh', 'kjhjkhkj', '(+897)8978-90-79');
/*!40000 ALTER TABLE `conjointe_employer` ENABLE KEYS */;

-- Dumping structure for table app-garaj.document_employer
DROP TABLE IF EXISTS `document_employer`;
CREATE TABLE IF NOT EXISTS `document_employer` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `id_employer` int(10) NOT NULL,
  `nom` varchar(100) DEFAULT NULL,
  `image` longtext DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_document_employer_employer` (`id_employer`),
  CONSTRAINT `FK_document_employer_employer` FOREIGN KEY (`id_employer`) REFERENCES `employer` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table app-garaj.document_employer: ~0 rows (approximately)
DELETE FROM `document_employer`;
/*!40000 ALTER TABLE `document_employer` DISABLE KEYS */;
/*!40000 ALTER TABLE `document_employer` ENABLE KEYS */;

-- Dumping structure for table app-garaj.employer
DROP TABLE IF EXISTS `employer`;
CREATE TABLE IF NOT EXISTS `employer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) DEFAULT NULL,
  `prenom` varchar(50) DEFAULT NULL,
  `sexe` varchar(50) DEFAULT NULL,
  `date_naissance` varchar(50) DEFAULT NULL,
  `nif` varchar(50) DEFAULT NULL,
  `cin` varchar(50) DEFAULT NULL,
  `adresse` varchar(1000) DEFAULT NULL,
  `telephone` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `religion` varchar(50) DEFAULT NULL,
  `statut_matrimonial` varchar(50) DEFAULT NULL,
  `date_entrer_en_travail` varchar(50) DEFAULT NULL,
  `poste` varchar(50) DEFAULT NULL,
  `service` varchar(50) DEFAULT NULL,
  `type_contrat` varchar(50) DEFAULT NULL,
  `actif` varchar(50) DEFAULT 'oui',
  `pinactif` varchar(50) DEFAULT NULL,
  `date_inactif` varchar(50) DEFAULT NULL,
  `user_inactif` varchar(50) DEFAULT NULL,
  `identifiant` varchar(50) DEFAULT NULL,
  `role` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `photo` longtext DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- Dumping data for table app-garaj.employer: ~0 rows (approximately)
DELETE FROM `employer`;
/*!40000 ALTER TABLE `employer` DISABLE KEYS */;
INSERT INTO `employer` (`id`, `nom`, `prenom`, `sexe`, `date_naissance`, `nif`, `cin`, `adresse`, `telephone`, `email`, `religion`, `statut_matrimonial`, `date_entrer_en_travail`, `poste`, `service`, `type_contrat`, `actif`, `pinactif`, `date_inactif`, `user_inactif`, `identifiant`, `role`, `password`, `photo`) VALUES
	(9, 'thomas', 'farana', 'masculin', '12/11/1111', '454-654-654-6', '56-46-54-5645-64-56456', 'delmas 45', '(+465)4656-54-65', 'dddd@gmail.com', 'n/a', 'cÃ©libataire', '90/89/0890', 'technicien', '2', 'xxx', 'non', 'null', 'null', 'null', 'fthomas 76', 'technicien', '2050d5887decbeb375491e3f3859bcd79c0c097d', 'null');
/*!40000 ALTER TABLE `employer` ENABLE KEYS */;

-- Dumping structure for table app-garaj.entrer_sortie
DROP TABLE IF EXISTS `entrer_sortie`;
CREATE TABLE IF NOT EXISTS `entrer_sortie` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `item` int(10) DEFAULT NULL,
  `no_transaction` varchar(50) DEFAULT NULL,
  `type_transaction` varchar(50) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `location` int(11) DEFAULT NULL,
  `quantite_avant` bigint(20) DEFAULT NULL,
  `quantite` varchar(20) DEFAULT NULL,
  `quantite_apres` bigint(20) DEFAULT NULL,
  `raison` varchar(3000) DEFAULT NULL,
  `destination` varchar(3000) DEFAULT NULL,
  `user` varchar(3000) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_entrer_sortie_stock` (`item`),
  KEY `FK_entrer_sortie_service` (`location`),
  CONSTRAINT `FK_entrer_sortie_service` FOREIGN KEY (`location`) REFERENCES `service` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_entrer_sortie_stock` FOREIGN KEY (`item`) REFERENCES `stock` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

-- Dumping data for table app-garaj.entrer_sortie: ~8 rows (approximately)
DELETE FROM `entrer_sortie`;
/*!40000 ALTER TABLE `entrer_sortie` DISABLE KEYS */;
INSERT INTO `entrer_sortie` (`id`, `item`, `no_transaction`, `type_transaction`, `date`, `location`, `quantite_avant`, `quantite`, `quantite_apres`, `raison`, `destination`, `user`) VALUES
	(1, 4, '33416', 'Ajout Item', '2020-05-24 05:57:56', 3, 0, '1000', 1000, '', '', ''),
	(3, 4, '455579', 'Invantaire - Modifier quantitÃ©', '2020-05-24 07:00:55', 3, 1000, '1005', 1005, '', '3', ''),
	(4, 5, '789371', 'Ajout Item', '2020-05-24 07:02:24', 3, 0, '87', 87, '', '', ''),
	(5, 5, 'A-872630', 'Augementation Stock', '2020-05-24 08:03:14', 3, 87, '3', 90, '', '', ''),
	(6, 5, 'A-811892', 'Augementation Stock', '2020-05-24 08:03:37', 3, 90, '10', 100, '', '', ''),
	(7, 4, 'A-185460', 'Augementation Stock', '2020-05-24 08:03:49', 3, 1005, '100', 1105, '', '', ''),
	(8, 6, '907810', 'Ajout Item', '2020-05-26 02:42:00', 3, 0, '1000', 1000, '', '', ''),
	(9, 7, '01129', 'Ajout Item', '2020-05-26 02:42:45', 3, 0, '1000', 1000, '', '', ''),
	(10, 8, '781822', 'Ajout Item', '2020-05-26 02:43:38', 3, 0, '1000', 1000, '', '', ''),
	(11, 7, 'A-790892', 'Augementation Stock', '2020-05-29 10:19:15', 3, 1000, '10', 1010, 'achat', '', ''),
	(12, 6, 'A-773928', 'Augementation Stock', '2020-05-29 10:19:15', 3, 1000, '10', 1010, 'achat', '', ''),
	(13, 7, 'A-444904', 'Augementation Stock', '2020-05-29 10:24:21', 3, 1000, '10', 1010, 'achat', '', ''),
	(14, 6, 'A-687378', 'Augementation Stock', '2020-05-29 10:24:21', 3, 1000, '10', 1010, 'achat', '', ''),
	(15, 7, 'A-636072', 'Augementation Stock : achat', '2020-05-29 10:43:57', 3, 1010, '10', 1020, 'achat', '', ''),
	(16, 6, 'A-601474', 'Augementation Stock : achat', '2020-05-29 10:43:57', 3, 1010, '10', 1020, 'achat', '', ''),
	(17, 5, 'A-626766', 'Augementation Stock : achat', '2020-05-29 10:43:57', 3, 100, '10', 110, 'achat', '', '');
/*!40000 ALTER TABLE `entrer_sortie` ENABLE KEYS */;

-- Dumping structure for table app-garaj.fournisseur
DROP TABLE IF EXISTS `fournisseur`;
CREATE TABLE IF NOT EXISTS `fournisseur` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) DEFAULT NULL,
  `telephone` varchar(50) DEFAULT NULL,
  `adresse` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `statut` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table app-garaj.fournisseur: ~1 rows (approximately)
DELETE FROM `fournisseur`;
/*!40000 ALTER TABLE `fournisseur` DISABLE KEYS */;
INSERT INTO `fournisseur` (`id`, `nom`, `telephone`, `adresse`, `email`, `statut`) VALUES
	(2, 'jean multi services', '(+509)4444-44-44', 'delmas 15 no 10', 'multi@gmail.com', 'actif');
/*!40000 ALTER TABLE `fournisseur` ENABLE KEYS */;

-- Dumping structure for table app-garaj.fournisseur_contact
DROP TABLE IF EXISTS `fournisseur_contact`;
CREATE TABLE IF NOT EXISTS `fournisseur_contact` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `id_fournisseur` int(20) NOT NULL,
  `nom` varchar(50) DEFAULT NULL,
  `poste` varchar(50) DEFAULT NULL,
  `telephone` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `FK_fournisseur_contact_fournisseur` (`id_fournisseur`),
  CONSTRAINT `FK_fournisseur_contact_fournisseur` FOREIGN KEY (`id_fournisseur`) REFERENCES `fournisseur` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- Dumping data for table app-garaj.fournisseur_contact: ~3 rows (approximately)
DELETE FROM `fournisseur_contact`;
/*!40000 ALTER TABLE `fournisseur_contact` DISABLE KEYS */;
INSERT INTO `fournisseur_contact` (`id`, `id_fournisseur`, `nom`, `poste`, `telephone`, `email`) VALUES
	(4, 2, 'alcindor losthelven', 'directeur', '(+509)4444-44-44', 'alcindorlos@gmail.com'),
	(5, 2, 'thomas farana', 'secretaire', '509444444444', 'thomasfarana@gmail.com'),
	(6, 2, 'louis merlin john', 'testeur', '509445552145', 'testeur@gmail.com');
/*!40000 ALTER TABLE `fournisseur_contact` ENABLE KEYS */;

-- Dumping structure for table app-garaj.historique
DROP TABLE IF EXISTS `historique`;
CREATE TABLE IF NOT EXISTS `historique` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user` varchar(50) DEFAULT NULL,
  `ip` varchar(50) DEFAULT NULL,
  `action` varchar(2000) DEFAULT NULL,
  `date` varchar(20) DEFAULT NULL,
  `heure` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- Dumping data for table app-garaj.historique: ~8 rows (approximately)
DELETE FROM `historique`;
/*!40000 ALTER TABLE `historique` DISABLE KEYS */;
INSERT INTO `historique` (`id`, `user`, `ip`, `action`, `date`, `heure`) VALUES
	(1, 'null', '::1', 'Ajouter employer', '2020-24-05', '04:11:38'),
	(2, 'null', '::1', 'Ajouter employer', '2020-24-05', '04:15:07'),
	(3, 'null', '::1', 'Ajouter employer', '2020-24-05', '04:18:36'),
	(4, 'null', '::1', 'Invetanire : ', '2020-24-05', '06:59:17'),
	(5, 'null', '::1', 'Invetanire ', '2020-24-05', '07:00:55'),
	(6, 'null', '::1', 'Ajouter item : hjhjh', '2020-24-05', '07:02:24'),
	(7, 'null', '::1', 'Ajouter item : macbook pro n-89', '2020-26-05', '02:42:00'),
	(8, 'null', '::1', 'Ajouter item : macbook pro n-50', '2020-26-05', '02:42:45'),
	(9, 'null', '::1', 'Ajouter item : dell inspiron 500', '2020-26-05', '02:43:38');
/*!40000 ALTER TABLE `historique` ENABLE KEYS */;

-- Dumping structure for table app-garaj.inventaire
DROP TABLE IF EXISTS `inventaire`;
CREATE TABLE IF NOT EXISTS `inventaire` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `service` int(11) DEFAULT NULL,
  `item` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `qt_avant` bigint(20) DEFAULT NULL,
  `qt_apres` bigint(20) DEFAULT NULL,
  `remarque` varchar(2000) DEFAULT NULL,
  `user` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_inventaire_service` (`service`),
  KEY `FK_inventaire_stock` (`item`),
  KEY `FK_inventaire_utilisateur` (`user`),
  CONSTRAINT `FK_inventaire_service` FOREIGN KEY (`service`) REFERENCES `service` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_inventaire_stock` FOREIGN KEY (`item`) REFERENCES `stock` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Dumping data for table app-garaj.inventaire: ~4 rows (approximately)
DELETE FROM `inventaire`;
/*!40000 ALTER TABLE `inventaire` DISABLE KEYS */;
INSERT INTO `inventaire` (`id`, `service`, `item`, `date`, `qt_avant`, `qt_apres`, `remarque`, `user`) VALUES
	(1, 3, 4, '2020-05-24', 1000, 1000, 'ok', NULL),
	(2, 3, 4, '2020-05-24', 1000, 850, 'ok', NULL),
	(3, 3, 4, '2020-05-24', 850, 1000, 'ok', NULL),
	(4, 3, 4, '2020-05-24', 1000, 1005, 'ok', NULL);
/*!40000 ALTER TABLE `inventaire` ENABLE KEYS */;

-- Dumping structure for table app-garaj.item_achat
DROP TABLE IF EXISTS `item_achat`;
CREATE TABLE IF NOT EXISTS `item_achat` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_achat` bigint(20) NOT NULL,
  `id_produit` int(11) NOT NULL,
  `quantite` int(11) DEFAULT NULL,
  `prix` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_item_achat_achat` (`id_achat`),
  KEY `FK_item_achat_stock` (`id_produit`),
  CONSTRAINT `FK_item_achat_achat` FOREIGN KEY (`id_achat`) REFERENCES `achat` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_item_achat_stock` FOREIGN KEY (`id_produit`) REFERENCES `stock` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

-- Dumping data for table app-garaj.item_achat: ~0 rows (approximately)
DELETE FROM `item_achat`;
/*!40000 ALTER TABLE `item_achat` DISABLE KEYS */;
INSERT INTO `item_achat` (`id`, `id_achat`, `id_produit`, `quantite`, `prix`) VALUES
	(8, 7, 7, 10, '70000'),
	(9, 7, 6, 10, '50000'),
	(10, 8, 7, 10, '70000'),
	(11, 8, 6, 10, '50000'),
	(12, 8, 5, 10, '100.00');
/*!40000 ALTER TABLE `item_achat` ENABLE KEYS */;

-- Dumping structure for table app-garaj.item_vente
DROP TABLE IF EXISTS `item_vente`;
CREATE TABLE IF NOT EXISTS `item_vente` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_vente` bigint(20) NOT NULL,
  `id_produit` int(11) NOT NULL,
  `prix` varchar(50) NOT NULL DEFAULT '0',
  `quantite` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_vente_id_produit` (`id_vente`,`id_produit`),
  KEY `FK_item_vente_stock` (`id_produit`),
  CONSTRAINT `FK_item_vente_stock` FOREIGN KEY (`id_produit`) REFERENCES `stock` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_item_vente_vente` FOREIGN KEY (`id_vente`) REFERENCES `vente` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=68 DEFAULT CHARSET=latin1;

-- Dumping data for table app-garaj.item_vente: ~5 rows (approximately)
DELETE FROM `item_vente`;
/*!40000 ALTER TABLE `item_vente` DISABLE KEYS */;
INSERT INTO `item_vente` (`id`, `id_vente`, `id_produit`, `prix`, `quantite`) VALUES
	(57, 26, 7, '70000', 1),
	(59, 27, 7, '70000', 2),
	(61, 28, 6, '50000', 2),
	(62, 27, 6, '50000', 1),
	(63, 29, 7, '70000', 1),
	(64, 29, 6, '50000', 1),
	(65, 30, 5, '100.00', 1),
	(66, 30, 7, '70000', 1),
	(67, 30, 6, '50000', 1);
/*!40000 ALTER TABLE `item_vente` ENABLE KEYS */;

-- Dumping structure for table app-garaj.personne_prevenir_employer
DROP TABLE IF EXISTS `personne_prevenir_employer`;
CREATE TABLE IF NOT EXISTS `personne_prevenir_employer` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `id_employer` int(10) NOT NULL,
  `nom` varchar(50) DEFAULT NULL,
  `prenom` varchar(50) DEFAULT NULL,
  `telephone` varchar(50) DEFAULT NULL,
  `relation` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_personne_a_prevenire_employer_employer` (`id_employer`),
  CONSTRAINT `FK_personne_a_prevenire_employer_employer` FOREIGN KEY (`id_employer`) REFERENCES `employer` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table app-garaj.personne_prevenir_employer: ~0 rows (approximately)
DELETE FROM `personne_prevenir_employer`;
/*!40000 ALTER TABLE `personne_prevenir_employer` DISABLE KEYS */;
INSERT INTO `personne_prevenir_employer` (`id`, `id_employer`, `nom`, `prenom`, `telephone`, `relation`) VALUES
	(3, 9, 'kjlkjlkj', 'kljlkjklj', '(+434)5353-45-34', 'kljkljklj');
/*!40000 ALTER TABLE `personne_prevenir_employer` ENABLE KEYS */;

-- Dumping structure for table app-garaj.repartition_stock
DROP TABLE IF EXISTS `repartition_stock`;
CREATE TABLE IF NOT EXISTS `repartition_stock` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `service` int(10) DEFAULT NULL,
  `item` int(10) DEFAULT NULL,
  `quantite` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_repartition_stock_service` (`service`),
  KEY `FK_repartition_stock_stock` (`item`),
  CONSTRAINT `FK_repartition_stock_service` FOREIGN KEY (`service`) REFERENCES `service` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_repartition_stock_stock` FOREIGN KEY (`item`) REFERENCES `stock` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Dumping data for table app-garaj.repartition_stock: ~5 rows (approximately)
DELETE FROM `repartition_stock`;
/*!40000 ALTER TABLE `repartition_stock` DISABLE KEYS */;
INSERT INTO `repartition_stock` (`id`, `service`, `item`, `quantite`) VALUES
	(1, 3, 4, 1105),
	(2, 3, 5, 110),
	(3, 3, 6, 1020),
	(4, 3, 7, 1020),
	(5, 3, 8, 1000);
/*!40000 ALTER TABLE `repartition_stock` ENABLE KEYS */;

-- Dumping structure for table app-garaj.service
DROP TABLE IF EXISTS `service`;
CREATE TABLE IF NOT EXISTS `service` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sigle` varchar(50) DEFAULT NULL,
  `definition` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table app-garaj.service: ~2 rows (approximately)
DELETE FROM `service`;
/*!40000 ALTER TABLE `service` DISABLE KEYS */;
INSERT INTO `service` (`id`, `sigle`, `definition`) VALUES
	(1, 'vente', ''),
	(2, 'reparation', NULL),
	(3, 'stock', NULL);
/*!40000 ALTER TABLE `service` ENABLE KEYS */;

-- Dumping structure for table app-garaj.stock
DROP TABLE IF EXISTS `stock`;
CREATE TABLE IF NOT EXISTS `stock` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `code` varchar(50) DEFAULT NULL,
  `groupe` varchar(50) DEFAULT NULL,
  `categorie` varchar(50) DEFAULT NULL,
  `nom` varchar(50) DEFAULT NULL,
  `nom_alternatif` varchar(50) DEFAULT NULL,
  `description` varchar(1000) DEFAULT NULL,
  `entrer_par` varchar(50) DEFAULT NULL,
  `quantite_par_type` varchar(50) DEFAULT '1',
  `retirer_par` varchar(50) DEFAULT NULL,
  `total_type` varchar(50) DEFAULT '1',
  `total_unite` varchar(50) DEFAULT '1',
  `cout` varchar(50) DEFAULT NULL,
  `prix` varchar(50) DEFAULT NULL,
  `quantite_maximale` varchar(50) DEFAULT NULL,
  `quantite_critique` varchar(50) DEFAULT NULL,
  `user` varchar(50) DEFAULT NULL,
  `actif` varchar(50) DEFAULT 'oui',
  `type` varchar(50) DEFAULT NULL,
  `date_expiration` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`),
  UNIQUE KEY `nom` (`nom`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- Dumping data for table app-garaj.stock: ~5 rows (approximately)
DELETE FROM `stock`;
/*!40000 ALTER TABLE `stock` DISABLE KEYS */;
INSERT INTO `stock` (`id`, `code`, `groupe`, `categorie`, `nom`, `nom_alternatif`, `description`, `entrer_par`, `quantite_par_type`, `retirer_par`, `total_type`, `total_unite`, `cout`, `prix`, `quantite_maximale`, `quantite_critique`, `user`, `actif`, `type`, `date_expiration`) VALUES
	(4, '1234', 'piece automobil', 'null', 'refracteur', 'piece', 'lds;jkflsdkfjlsdkjflkds', 'unite', '1000', 'unite', '1105', '1105', '750.00', '750.00', '1000', '50', 'null', 'oui', 'null', '12/12/1990'),
	(5, '6675', 'piece automobil', 'null', 'bougie', 'bougie', 'khkjkhj', 'unite', '87', 'unite', '110', '110', '100.00', '100.00', '78678', '77', 'null', 'oui', 'vendu', '12/12/1990'),
	(6, 'mc-543', 'piece automobil', NULL, 'macbook pro n-89', 'macbook', 'apple ordinateur', 'unite', '1000', 'unite', '1020', '1020', '50000', '50000', '1000', '5', 'null', 'oui', 'vendu', '12/12/1990'),
	(7, 'mc-878', 'piece automobil', NULL, 'macbook pro n-50', 'macbook', 'macbook', 'unite', '1000', 'unite', '1020', '1020', '70000', '70000', '1000', '10', 'null', 'oui', 'vendu', '12/12/1990'),
	(8, 'del-89', 'piece automobil', NULL, 'dell inspiron 500', 'dell pc', 'ordinateur portable', 'unite', '1000', 'unite', '1000', '1000', '752000', '752000', '1000', '10', 'null', 'oui', 'vendu', '12/12/1990');
/*!40000 ALTER TABLE `stock` ENABLE KEYS */;

-- Dumping structure for table app-garaj.utilisateur
DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `role` varchar(50) DEFAULT NULL,
  `nom` varchar(50) DEFAULT NULL,
  `prenom` varchar(50) DEFAULT NULL,
  `motdepasse` text DEFAULT NULL,
  `active` enum('oui','non') DEFAULT NULL,
  `statut` enum('1','0') DEFAULT '0',
  `telephone` varchar(50) DEFAULT NULL,
  `photo` varchar(1000) DEFAULT NULL,
  `id_session` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `pseudo` (`pseudo`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table app-garaj.utilisateur: 1 rows
DELETE FROM `utilisateur`;
/*!40000 ALTER TABLE `utilisateur` DISABLE KEYS */;
INSERT INTO `utilisateur` (`id`, `pseudo`, `email`, `role`, `nom`, `prenom`, `motdepasse`, `active`, `statut`, `telephone`, `photo`, `id_session`) VALUES
	(1, 'admin', 'admin@gmail.com', 'admin', NULL, NULL, 'd033e22ae348aeb5660fc2140aec35850c4da997', 'oui', '0', NULL, NULL, NULL);
/*!40000 ALTER TABLE `utilisateur` ENABLE KEYS */;

-- Dumping structure for table app-garaj.vente
DROP TABLE IF EXISTS `vente`;
CREATE TABLE IF NOT EXISTS `vente` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_client` int(11) NOT NULL,
  `numero` varchar(50) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `date_paiement` varchar(50) DEFAULT NULL,
  `payer` enum('oui','non') DEFAULT 'non',
  `taxe` varchar(50) DEFAULT '0',
  `deduction` varchar(50) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `FK_vente_client` (`id_client`),
  CONSTRAINT `FK_vente_client` FOREIGN KEY (`id_client`) REFERENCES `client` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;

-- Dumping data for table app-garaj.vente: ~4 rows (approximately)
DELETE FROM `vente`;
/*!40000 ALTER TABLE `vente` DISABLE KEYS */;
INSERT INTO `vente` (`id`, `id_client`, `numero`, `date`, `date_paiement`, `payer`, `taxe`, `deduction`) VALUES
	(26, 6, '86524210979', '2020-05-26', '2020-05-26', 'oui', '5.6', '0'),
	(27, 7, '53581827823', '2020-05-26', '2020-05-29', 'oui', '5.6', '0'),
	(28, 6, '35258761904', '2020-05-27', '2020-05-29', 'oui', '5.6', '0'),
	(29, 6, '93426253564', '2020-05-29', '2020-05-29', 'oui', '5.6', '0'),
	(30, 7, '59183885175', '2020-05-29', 'n/a', 'non', '5.6', '0');
/*!40000 ALTER TABLE `vente` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
