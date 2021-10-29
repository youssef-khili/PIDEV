/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package gestionutilisateurs.entites;

/**
 *
 * @author khili youssef
 */

public class Utilisateur {
    
   public enum Roles{
    ADMIN,PROPOSATEUR,BENEFICIAIRE,RESPONSABLE_ACT;
}
   public enum Type_service{
    COVOITURAGE,LIVRAISON;
}
   private int id_user,num_tel,cout;
   private String nom_user, prenom_user,email,username,password,depart,destination;
   private Roles role;
   private Type_service type_service;

    public Utilisateur() {
    }
   


    public Utilisateur(int id_user, int num_tel, int cout, String nom_user, String prenom_user, String email, String username, String password, String départ, String destination, Roles role, Type_service type_service) {
        this.id_user = id_user;
        this.num_tel = num_tel;
        this.cout = cout;
        this.nom_user = nom_user;
        this.prenom_user = prenom_user;
        this.email = email;
        this.username = username;
        this.password = password;
        this.depart = depart;
        this.destination = destination;
        this.role = role;
        this.type_service = type_service;
    }

    public Utilisateur(int num_tel, int cout, String nom_user, String prenom_user, String email, String username, String password, String départ, String destination, Roles role, Type_service type_service) {
        this.num_tel = num_tel;
        this.cout = cout;
        this.nom_user = nom_user;
        this.prenom_user = prenom_user;
        this.email = email;
        this.username = username;
        this.password = password;
        this.depart = depart;
        this.destination = destination;
        this.role = role;
        this.type_service = type_service;
    }

    public int getId_user() {
        return id_user;
    }

    public int getNum_tel() {
        return num_tel;
    }

    public int getCout() {
        return cout;
    }

    public String getNom_user() {
        return nom_user;
    }

    public String getPrenom_user() {
        return prenom_user;
    }

    public String getEmail() {
        return email;
    }

    public String getUsername() {
        return username;
    }

    public String getPassword() {
        return password;
    }

    public String getDepart() {
        return depart;
    }

    public String getDestination() {
        return destination;
    }

    public Roles getRole() {
        return role;
    }

    public Type_service getType_service() {
        return type_service;
    }

    public void setId_user(int id_user) {
        this.id_user = id_user;
    }

    public void setNum_tel(int num_tel) {
        this.num_tel = num_tel;
    }

    public void setCout(int cout) {
        this.cout = cout;
    }

    public void setNom_user(String nom_user) {
        this.nom_user = nom_user;
    }

    public void setPrenom_user(String prenom_user) {
        this.prenom_user = prenom_user;
    }

    public void setEmail(String email) {
        this.email = email;
    }

    public void setUsername(String username) {
        this.username = username;
    }

    public void setPassword(String password) {
        this.password = password;
    }

    public void setDepart(String départ) {
        this.depart = depart;
    }

    public void setDestination(String destination) {
        this.destination = destination;
    }

    public void setRole(Roles role) {
        this.role = role;
    }

    public void setType_service(Type_service type_service) {
        this.type_service = type_service;
    }

    @Override
    public String toString() {
        return "Utilisateur{" + "id_user=" + id_user + ", nom=" + nom_user + ", prenom=" + prenom_user + ", email=" + email + ", num_tel=" + num_tel + ", username=" + username + ", password=" + password + ", depart=" + depart + ", destination=" + destination + ", cout=" + cout + ", type_service=" + type_service + ", role=" + role + '}'+"\n";
    }

  
    
    
    

    
   
   
    
}
