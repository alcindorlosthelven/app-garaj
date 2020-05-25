DELETE FROM laboratoire_predefinie;
INSERT INTO laboratoire_predefinie(nom,type_resultat,valeur_normal_min,valeur_normal_max,unite_valeur)VALUE
('hemoglobine','min_max',11,20,'g/dl'),
('hematocrite','min_max',36,60,'%'),
('globules_rouge','min_max',3.6,5.8,'g/l'),
('globules_blancs','min_max',4,10,'g/l'),
('neutrophiles','min_max',50,60,'%'),
('lymphocytes','min_max',20,40,'%'),
('eosinophile','min_max',0,4,'%'),
('basophile','min_max',0,1,'%'),
('neutrophiles','autre','','',''),
('mcv','min_max',80,100,'fl'),
('mchm_mgg','min_max',27,32,'pg'),
('mchc','min_max',30,35,'%'),
('plaquettes','min_max',150,4000,'mille'),
('remarques','autre','','','')
;
