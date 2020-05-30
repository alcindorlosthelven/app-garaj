<?php
use app\DefaultApp\DefaultApp as App;
App::get("/", "utilisateur.lister", "index");
App::post("/", "utilisateur.lister","index_post");

//depense
App::get("/depense", "depense.lister", "depense");
App::get("/ajouter-depense", "depense.ajouter", "ajouter_depense");
App::post("/ajouter-depense", "depense.ajouter", "ajouter_depense");
App::get("/lister-depense", "depense.lister", "lister_depense");
App::get("/modifier-depense-:id", "depense.modifier", "modifier_depense")->avec("id","[0-9]+");
App::post("/modifier-depense-:id", "depense.modifier", "modifier_depense")->avec("id","[0-9]+");
//fin depense

//client
App::get("/client", "client.lister", "client");
App::get("/ajouter-client", "client.ajouter", "ajouter_client");
App::post("/ajouter-client", "client.ajouter", "ajouter_client");
App::get("/lister-client", "client.lister", "lister_client");
App::get("/modifier-client-:id", "client.modifier", "modifier_client")->avec("id","[0-9]+");
App::post("/modifier-client-:id", "client.modifier", "modifier_client")->avec("id","[0-9]+");
App::get("/fiche-client-:id", "client.fiche", "fiche_client")->avec("id","[0-9]+");
//fin client


//vente
App::get("/vente", "vente.lister", "vente");
App::get("/ajouter-vente-:id", "vente.ajouter", "ajouter_vente")->avec("id",'[0-9]+');
App::get("/lister-vente", "vente.lister", "lister_vente");
App::get("/imprimer-facture-vente-:id", "print.imprimer")->avec("id",'[0-9]+');
App::get("/facture-vente-:id", "vente.factureVente","facture_vente")->avec("id",'[0-9]+');
//fin vente

//achat
App::get("/achat", "achat.lister", "achat");
App::get("/ajouter-achat-:id", "achat.ajouter", "ajouter_achat")->avec("id",'[0-9]+');
App::get("/lister-achat", "achat.lister", "lister_achat");
App::get("/facture-achat-:id", "achat.factureAchat","facture_achat")->avec("id",'[0-9]+');
App::get("/imprimer-facture-achat-:id", "print.imprimerAchat")->avec("id",'[0-9]+');
//fin achat


//employer
App::get("/employer", "employer.index", "employer");
App::get("/ajouter-employer", "employer.ajouter", "ajouter_employer");
App::get("/lister-employer", "employer.index", "lister_employer");
App::post("/lister-employer", "employer.index", "lister_employer");
App::get("/modifier-employer-:id", "employer.modifier", "modifier_employer")->avec("id",'[0-9]+');
App::get("/fiche-employer-:id", "employer.fiche", "fiche_employer")->avec("id",'[0-9]+');
//fin employer


//fournisseur
App::get("/fournisseur", "fournisseur.lister", "fournisseur");
App::get("/ajouter-fournisseur", "fournisseur.ajouter", "ajouter_fournisseur");
App::post("/ajouter-fournisseur", "fournisseur.ajouter", "ajouter_fournisseur");
App::get("/lister-fournisseur", "fournisseur.lister", "lister_fournisseur");
App::get("/modifier-fournisseur-:id", "fournisseur.modifier", "modifier_fournisseur")->avec("id","[0-9]+");
App::post("/modifier-fournisseur-:id", "fournisseur.modifier", "modifier_fournisseur")->avec("id","[0-9]+");
App::get("/fiche-fournisseur-:id", "fournisseur.fiche", "fiche_fournisseur")->avec("id","[0-9]+");
//fin fournisseur

//utilisateur
App::get("/utilisateur", "utilisateur.lister","utilisateur");
App::get("/ajouter-utilisateur", "utilisateur.ajouter", "ajouter_utilisateur");
App::post("/ajouter-utilisateur", "utilisateur.ajouter","ajouter_utilisateur");
App::get("/lister-utilisateur", "utilisateur.lister", "lister_utilisateur");
App::get("/blocker-utilisateur-:id", "utilisateur.blocker", "blocker_utilisateur")->avec("id", "['0-9']+");
App::get("/deblocker-utilisateur-:id", "utilisateur.deblocker", "deblocker_utilisateur")->avec("id", "['0-9']+");
App::get("/supprimer-utilisateur-:id", "utilisateur.supprimer", "supprimer_utilisateur")->avec("id", "['0-9']+");
App::get("/modifier-utilisateur-:id", "utilisateur.modifier", "modifier_utilisateur")->avec("id", "['0-9']+");
App::post("/modifier-utilisateur-:id", "utilisateur.modifier")->avec("id", "['0-9']+");
//fin utilisateur

//stock
App::get("/stock", "stock.index","stock");
App::get("/nouveau-item", "stock.ajouter","nouveau_item");
App::get("/liste-item", "stock.index","liste_item");
App::get("/modifier-item-:id", "stock.modifier", "modifier_item")->avec("id", "['0-9']+");
App::post("/modifier-item-:id", "stock.modifier", "modifier_item")->avec("id", "['0-9']+");

App::get("/historique-item-:id", "stock.historiqueItem", "historique_item")->avec("id", "['0-9']+");
App::get("/repartition-item-:id", "stock.repartition", "repartition_item")->avec("id", "['0-9']+");
App::get("/repartition-item", "stock.repartition", "repartition_item");
App::get("/transfert-item", "stock.transfert", "transfert_item");
App::get("/retirer-item", "stock.retirer", "retirer_item");
App::get("/bon-utilisation", "stock.bonUtilisation", "bon_utilisation");
App::get("/inventory", "stock.inventaire", "inventaire");
App::get("/historique", "stock.historique", "historique");
//fin stock











