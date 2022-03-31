-- INSERTION PERSONNE

INSERT INTO personne (per_nom, per_prenom, per_mail, per_tel_perso) VALUES ('Seité', 'Alexandre', 'aseite@digiworks.fr', '0278770260');
INSERT INTO personne (per_nom, per_mail, per_tel_perso) VALUES ('Leuleu', 'l.leuleu@agevol.fr', '0332181832');
INSERT INTO personne (per_nom, per_prenom, per_mail) VALUES ('Soumillon', 'loïc', 'l.soumillon@dreux-agglomeration.fr');
INSERT INTO personne (per_nom, per_prenom, per_mail) VALUES ('Barré', 'Stéphane', 's.barre@agisoft-e.fr');
INSERT INTO personne (per_nom, per_prenom, per_mail) VALUES ('Loïc', 'Soumillon', 'l.soumillon@dreux-agglomeration.fr');
INSERT INTO personne (per_nom, per_prenom, per_mail, per_tel_perso) VALUES ('Ronan', 'Pensec', 'ronan.pensec@alstomgroup.com','0760901598');
INSERT INTO personne (per_prenom,per_nom, per_mail, per_tel_perso, per_tel_pro) VALUES ('Christophe', 'Delmas', 'christophe.delmas@alta-soft.com', '0972307020', '0972307020');
INSERT INTO personne (per_prenom,per_nom, per_mail) VALUES ('Régis', 'Lepelletier', 'r.leppeletier@alternative-conseil.com');
INSERT INTO personne (per_prenom,per_nom, per_mail) VALUES ('David', 'Avigni', 'david.avigni@ankapi.com');
INSERT INTO personne (per_prenom,per_nom, per_mail, per_tel_perso) VALUES ('Jérémy', 'Bruneau', 'jeremy.bruneau@apave.com', '0778860116');
INSERT INTO personne (per_prenom,per_nom, per_mail, per_tel_perso, per_tel_pro) VALUES ('Frédéric', 'Henry', 'f.henry-cs@attineos.com', '0652333636', '0235764739');
INSERT INTO personne (per_prenom,per_nom, per_mail) VALUES ('David', 'Michel', 'david.michel@autoliv.com');
INSERT INTO personne (per_prenom,per_nom, per_mail, per_tel_perso) VALUES ('Renan', 'Decamp', 'renan@bearstudio.fr', '0760391776');
INSERT INTO personne (per_prenom,per_nom, per_mail, per_tel_perso) VALUES ('Aurélien', 'Andres', 'aurelien.andres@benteler.com', '0633562780');
INSERT INTO personne (per_prenom,per_nom, per_mail, per_tel_perso) VALUES ('Antoine', 'Lepiller', 'alepiller@bimandco.com', '0763916210');
INSERT INTO personne (per_prenom,per_nom, per_mail, per_tel_perso, per_tel_pro) VALUES ('Jean-Marc', 'Le Denmat', 'jean-marc.le-denmat@chb.unicancer.fr', '0232082209', '0232082958');

-- INSERTION ENTREPRISE

INSERT INTO ENTREPRISE (ent_rs, ent_adresse, ent_cp, ent_ville, ent_pays) VALUES ('ABC INFORMATIQUE', 'Zac Le Parc Allée des marettes', '80130', 'FRIVILLE', 'France');
INSERT INTO ENTREPRISE (ent_rs, ent_adresse, ent_cp, ent_ville, ent_pays) VALUES ('Agence Digiworks', '85 Chemin de Clères', '76130', 'Mont-Saint-Aignan', 'France');
INSERT INTO ENTREPRISE (ent_rs, ent_adresse, ent_cp, ent_ville, ent_pays) VALUES ('AGEVOL Développement', '10 rue du Maréchal De Lattre de Tassigny', '76420', 'Bihorel', 'France');
INSERT INTO ENTREPRISE (ent_rs, ent_adresse, ent_cp, ent_ville, ent_pays) VALUES ('Agglo du Pays de Dreux', '4 rue du Châteaudun BP20159', '28103', 'Dreux cedex', 'France');
INSERT INTO ENTREPRISE (ent_rs, ent_adresse, ent_cp, ent_ville, ent_pays) VALUES ('AGISOFT Engineering', '79 rue Louis Blériot Zone EuroChannel', '76370', 'Martin Eglise', 'France');
INSERT INTO ENTREPRISE (ent_rs, ent_adresse, ent_cp, ent_ville, ent_pays) VALUES ('ALSTOM Petitquevilly', '9 rue des patis CS50154', '76144', 'PETIT QUEVILLY', 'France');
INSERT INTO ENTREPRISE (ent_rs, ent_adresse, ent_cp, ent_ville, ent_pays) VALUES ('ALTASOFT', '6 rue Gustave Eiffel', '76230', 'BOIS GUILLAUME', 'France');
INSERT INTO ENTREPRISE (ent_rs, ent_adresse, ent_cp, ent_ville, ent_pays) VALUES ('Alternative-conseil', '13 Avenue des Canadiens', '76800', 'St Etienne du Rouvray', 'France');
INSERT INTO ENTREPRISE (ent_rs, ent_adresse, ent_cp, ent_ville, ent_pays) VALUES ('ANKAPI', 'Seine Innopolis', '76144', 'Le Petit-Quevilly', 'France');
INSERT INTO ENTREPRISE (ent_rs, ent_adresse, ent_cp, ent_ville, ent_pays) VALUES ('APAVE', '2 rue des mouettes', '76130', 'Mont Saint Aignan', 'France');
INSERT INTO ENTREPRISE (ent_rs, ent_adresse, ent_cp, ent_ville, ent_pays) VALUES ('ATTINEOS', '72 rue de la République', '76140', 'Le Petit-Quevilly', 'France');
INSERT INTO ENTREPRISE (ent_rs, ent_adresse, ent_cp, ent_ville, ent_pays) VALUES ('AUTOLIV ELECTRONIC France', 'Boulevard Lénine', '76800', 'Saint-étienne-du-Rouvray', 'France');
INSERT INTO ENTREPRISE (ent_rs, ent_adresse, ent_cp, ent_ville, ent_pays) VALUES ('Bearstudio', '72 rue de la République', '76140', 'Le Petit-Quevilly', 'France');
INSERT INTO ENTREPRISE (ent_rs, ent_adresse, ent_cp, ent_ville, ent_pays) VALUES ('Benteler Aluminium System', 'Parc industriel d''Incarville', '27400', 'Louviers', 'France');
INSERT INTO ENTREPRISE (ent_rs, ent_adresse, ent_cp, ent_ville, ent_pays) VALUES ('BIM&CO', 'Parc Eco Normandie', '76430', 'Saint Romain de Colbosc', 'France');
INSERT INTO ENTREPRISE (ent_rs, ent_adresse, ent_cp, ent_ville, ent_pays) VALUES ('Centre Henri-Becquerel', 'Rue d''Amiens', '76038', 'Rouen Cedex 1', 'France');

-- INSERTION ENTREPRISE PERSONNE

INSERT INTO entreprise_personne (entreprise_id, personne_id) VALUES ('1','1');
INSERT INTO entreprise_personne (entreprise_id, personne_id) VALUES ('2','2');
INSERT INTO entreprise_personne (entreprise_id, personne_id) VALUES ('3','3');
INSERT INTO entreprise_personne (entreprise_id, personne_id) VALUES ('4','4');
INSERT INTO entreprise_personne (entreprise_id, personne_id) VALUES ('5','5');
INSERT INTO entreprise_personne (entreprise_id, personne_id) VALUES ('6','6');
INSERT INTO entreprise_personne (entreprise_id, personne_id) VALUES ('7','7');
INSERT INTO entreprise_personne (entreprise_id, personne_id) VALUES ('8','8');
INSERT INTO entreprise_personne (entreprise_id, personne_id) VALUES ('9','9');
INSERT INTO entreprise_personne (entreprise_id, personne_id) VALUES ('10','10');
INSERT INTO entreprise_personne (entreprise_id, personne_id) VALUES ('11','11');
INSERT INTO entreprise_personne (entreprise_id, personne_id) VALUES ('12','12');
INSERT INTO entreprise_personne (entreprise_id, personne_id) VALUES ('13','13');
INSERT INTO entreprise_personne (entreprise_id, personne_id) VALUES ('14','14');
INSERT INTO entreprise_personne (entreprise_id, personne_id) VALUES ('15','15');
INSERT INTO entreprise_personne (entreprise_id, personne_id) VALUES ('16','16');

-- INSERTION SPECIALITE

INSERT INTO SPECIALITE (spe_libelle) VALUES ('1 SIO SLAM');
INSERT INTO SPECIALITE (spe_libelle) VALUES ('2 SIO SLAM');
INSERT INTO SPECIALITE (spe_libelle) VALUES ('1 SIO SISR');
INSERT INTO SPECIALITE (spe_libelle) VALUES ('2 SIO SISR');

-- INSERTION ENTREPRISE SPECIALITE

INSERT INTO entreprise_specialite (entreprise_id, specialite_id) VALUES ('7','1');
INSERT INTO entreprise_specialite (entreprise_id, specialite_id) VALUES ('7','2');
INSERT INTO entreprise_specialite (entreprise_id, specialite_id) VALUES ('16','1');
INSERT INTO entreprise_specialite (entreprise_id, specialite_id) VALUES ('16','2');
INSERT INTO entreprise_specialite (entreprise_id, specialite_id) VALUES ('16','3');
INSERT INTO entreprise_specialite (entreprise_id, specialite_id) VALUES ('16','4');

-- INSERTION FONCTION 

INSERT INTO fonction (fon_libelle) VALUES ('Directeur de production');
INSERT INTO fonction (fon_libelle) VALUES ('Administrateur Système et Réseaux');
INSERT INTO fonction (fon_libelle) VALUES ('Directeur de projets');
INSERT INTO fonction (fon_libelle) VALUES ('Responsable service développement');
INSERT INTO fonction (fon_libelle) VALUES ('Directeur des Systèmes d''information');

-- INSERTION PERSONNE FONCTION

INSERT INTO personne_fonction (personne_id, fonction_id) VALUES ('2','1');
INSERT INTO personne_fonction (personne_id, fonction_id) VALUES ('4','2');
INSERT INTO personne_fonction (personne_id, fonction_id) VALUES ('11','3');
INSERT INTO personne_fonction (personne_id, fonction_id) VALUES ('15','4');
INSERT INTO personne_fonction (personne_id, fonction_id) VALUES ('16','5');

-- INSERTION PROFIL

INSERT INTO profil (pro_type) VALUES ('Responsable');
INSERT INTO profil (pro_type) VALUES ('Tuteur');
INSERT INTO profil (pro_type) VALUES ('Jury');
INSERT INTO profil (pro_type) VALUES ('Envoi de CV');

-- INSERTION UTILISATEUR

INSERT INTO utilisateur (uti_login,uti_mdp,uti_admin) VALUES ('tGarin','test',0);
INSERT INTO utilisateur (uti_login,uti_mdp,uti_admin) VALUES ('pDelamare','1234',1);

-- INSERTION PERSONNE PROFIL

