/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package gestion.livraison.entities;

/**
 *
 * @author User */

public class livraison {
    
    private int id_liv , tarif , poids_unitaire ;
    
    private String depart, arrive , type_objet , emplacement_et_etat ;

    public livraison() {
    }

    public livraison( String depart, String arrive,int tarif, String type_objet, String emplacement_et_etat,int poids_unitaire) {
        this.depart = depart;
        this.arrive = arrive;
        this.tarif = tarif;
        this.type_objet = type_objet;
        this.emplacement_et_etat = emplacement_et_etat;
        this.poids_unitaire = poids_unitaire;
    }
    
    public livraison(int id_liv, String depart, String arrive,int tarif, String type_objet, String emplacement_et_etat,int poids_unitaire) {
        this.id_liv = id_liv;
        this.depart = depart;
        this.arrive = arrive;
        this.tarif = tarif;
        this.type_objet = type_objet;
        this.emplacement_et_etat = emplacement_et_etat;
        this.poids_unitaire = poids_unitaire;
    }

    
    
    
    
    
    public int getId_liv() {
        return id_liv;
    }

    public void setId_liv(int id_liv) {
        this.id_liv = id_liv;
    }

    public String getDepart() {
        return depart;
    }

    public void setDepart(String depart) {
        this.depart = depart;
    }

    public String getArrive() {
        return arrive;
    }

    public void setArrive(String arrive) {
        this.arrive = arrive;
    }
    public int getTarif() {
        return tarif;
    }

    public void setTarif(int tarif) {
        this.tarif = tarif;
    }
public String getType_objet() {
        return type_objet;
    }

    public void setType_objet(String type_objet) {
        this.type_objet = type_objet;
    }

public String getEmplacement_et_etat() {
        return emplacement_et_etat;
    }

    public void setEmplacement_et_etat(String emplacement_et_etat) {
        this.emplacement_et_etat = emplacement_et_etat;
    }
     public int getPoids_unitaire() {
        return poids_unitaire;
    }

    public void setPoids_unitaire(int poids_unitaire) {
        this.poids_unitaire = poids_unitaire;
    }
    @Override
    public String toString() {
        return "livraison{" + "id_liv=" + id_liv + ", depart=" + depart + ", arrive=" + arrive +", tarif=" + tarif +", type_objet=" + type_objet +", emplacement_et_etat=" + emplacement_et_etat +", poids_unitaire=" + poids_unitaire + "}\n";
    }
    
    
}
