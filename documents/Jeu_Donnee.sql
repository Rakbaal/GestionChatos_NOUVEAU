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

-- INSERTION PERSONNE

INSERT INTO personne (per_nom, per_prenom, per_mail, per_tel_perso, entreprise_id) VALUES ('Seité', 'Alexandre', 'aseite@digiworks.fr', '0278770260', '1');
INSERT INTO personne (per_nom, per_mail, per_tel_perso, entreprise_id) VALUES ('Leuleu', 'l.leuleu@agevol.fr', '0332181832', '2');
INSERT INTO personne (per_nom, per_prenom, per_mail, entreprise_id) VALUES ('Soumillon', 'loïc', 'l.soumillon@dreux-agglomeration.fr', '16');
INSERT INTO personne (per_nom, per_prenom, per_mail, entreprise_id) VALUES ('Barré', 'Stéphane', 's.barre@agisoft-e.fr', '3');
INSERT INTO personne (per_nom, per_prenom, per_mail, entreprise_id) VALUES ('Loïc', 'Soumillon', 'l.soumillon@dreux-agglomeration.fr', '4');
INSERT INTO personne (per_nom, per_prenom, per_mail, per_tel_perso, entreprise_id) VALUES ('Ronan', 'Pensec', 'ronan.pensec@alstomgroup.com','0760901598', '5');
INSERT INTO personne (per_prenom,per_nom, per_mail, per_tel_perso, per_tel_pro, entreprise_id) VALUES ('Christophe', 'Delmas', 'christophe.delmas@alta-soft.com', '0972307020', '0972307020', '6');
INSERT INTO personne (per_prenom,per_nom, per_mail, entreprise_id) VALUES ('Régis', 'Lepelletier', 'r.leppeletier@alternative-conseil.com', '7');
INSERT INTO personne (per_prenom,per_nom, per_mail, entreprise_id) VALUES ('David', 'Avigni', 'david.avigni@ankapi.com', '8');
INSERT INTO personne (per_prenom,per_nom, per_mail, per_tel_perso, entreprise_id) VALUES ('Jérémy', 'Bruneau', 'jeremy.bruneau@apave.com', '0778860116', '9');
INSERT INTO personne (per_prenom,per_nom, per_mail, per_tel_perso, per_tel_pro, entreprise_id) VALUES ('Frédéric', 'Henry', 'f.henry-cs@attineos.com', '0652333636', '0235764739', '10');
INSERT INTO personne (per_prenom,per_nom, per_mail, entreprise_id) VALUES ('David', 'Michel', 'david.michel@autoliv.com', '11');
INSERT INTO personne (per_prenom,per_nom, per_mail, per_tel_perso, entreprise_id) VALUES ('Renan', 'Decamp', 'renan@bearstudio.fr', '0760391776', '12');
INSERT INTO personne (per_prenom,per_nom, per_mail, per_tel_perso, entreprise_id) VALUES ('Aurélien', 'Andres', 'aurelien.andres@benteler.com', '0633562780', '13');
INSERT INTO personne (per_prenom,per_nom, per_mail, per_tel_perso, entreprise_id) VALUES ('Antoine', 'Lepiller', 'alepiller@bimandco.com', '0763916210', '14');
INSERT INTO personne (per_prenom,per_nom, per_mail, per_tel_perso, per_tel_pro, entreprise_id) VALUES ('Jean-Marc', 'Le Denmat', 'jean-marc.le-denmat@chb.unicancer.fr', '0232082209', '0232082958', '15');

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

INSERT INTO utilisateur (uti_login,uti_mdp,uti_admin) VALUES ('tGarin','9f86d081884c7d659a2feaa0c55ad015a3bf4f1b2b0b822cd15d6c15b0f00a08',0);
INSERT INTO utilisateur (uti_login,uti_mdp,uti_admin) VALUES ('pDelamare','03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4',1);

-- INSERTION PERSONNE PROFIL

INSERT INTO personne_profil (personne_id,profil_id) VALUES ('5','1');
INSERT INTO personne_profil (personne_id,profil_id) VALUES ('1','2');
INSERT INTO personne_profil (personne_id,profil_id) VALUES ('16','2');
INSERT INTO personne_profil (personne_id,profil_id) VALUES ('10','2');
INSERT INTO personne_profil (personne_id,profil_id) VALUES ('8','3');
INSERT INTO personne_profil (personne_id,profil_id) VALUES ('2','3');
INSERT INTO personne_profil (personne_id,profil_id) VALUES ('7','4');
INSERT INTO personne_profil (personne_id,profil_id) VALUES ('11','4');