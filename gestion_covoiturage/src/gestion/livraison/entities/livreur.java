/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package gestion.livraison.entities;

/**
 *
 * @author User
 */
public class livreur {
private int id_livreur , num_tel , cin , rate ;
    
    private String nom, prenom ;

public livreur(){
}

    public livreur(int id_livreur, int num_tel, int cin, int rate, String nom, String prenom) {
        this.id_livreur = id_livreur;
        this.nom = nom;
        this.prenom = prenom;
        this.num_tel = num_tel;
        this.cin = cin;
        this.rate = rate;

    }

    public livreur(int num_tel, int cin, int rate, String nom, String prenom) {
        this.num_tel = num_tel;
        this.cin = cin;
        this.rate = rate;
        this.nom = nom;
        this.prenom = prenom;
    }

    public int getId_livreur() {
        return id_livreur;
    }

    public void setId_livreur(int id_livreur) {
        this.id_livreur = id_livreur;
    }

    public int getNum_tel() {
        return num_tel;
    }

    public void setNum_tel(int num_tel) {
        this.num_tel = num_tel;
    }

    public int getCin() {
        return cin;
    }

    public void setCin(int cin) {
        this.cin = cin;
    }

    public int getRate() {
        return rate;
    }

    public void setRate(int rate) {
        this.rate = rate;
    }

    public String getNom() {
        return nom;
    }

    public void setNom(String nom) {
        this.nom = nom;
    }

    public String getPrenom() {
        return prenom;
    }

    public void setPrenom(String prenom) {
        this.prenom = prenom;
    }
@Override
    public String toString() {
        return "livreur{" + "id_livreur=" + id_livreur + ", num_tel=" + num_tel + ", cin=" + cin +", rate=" + rate +", nom=" + nom +", prenom=" + prenom +"}\n";
}
}

