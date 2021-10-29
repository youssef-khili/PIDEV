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
    ADMIN,RESPONSABLE_COVOIT,RESPONSABLE_LIV,RESPONSABLE_ACT,RESPONSABLE_TRANS_PUBLIC,RESPONSABLE_PUB;
}
   public enum Type_service{
     COVOITURAGE,LIVRAISON,ADMIN,TRANSPORT_PUBLIC,PUBLICITE,ACTUALITES;
}
   private int id_user;
   private String nom_user;
   private String prenom_user;
   private String email;
   private int num_tel;
   private String username;
   private String password;
   private String depart;
   private String destination;
   private int cout;
   private Type_service type_service;
   private Roles role;

    public Utilisateur() {
    }

    public Utilisateur(String username, String password, Type_service type_service, Roles role) {
        this.username = username;
        this.password = password;
        this.type_service = type_service;
        this.role = role;
    }
    

    public Utilisateur(int id_user, String nom_user, String prenom_user, String email, int num_tel, String username, String password, String depart, String destination, int cout, Type_service type_service, Roles role) {
        this.id_user = id_user;
        this.nom_user = nom_user;
        this.prenom_user = prenom_user;
        this.email = email;
        this.num_tel = num_tel;
        this.username = username;
        this.password = password;
        this.depart = depart;
        this.destination = destination;
        this.cout = cout;
        this.type_service = type_service;
        this.role = role;
    }

    public Utilisateur(String nom_user, String prenom_user, String email, int num_tel, String username, String password, String depart, String destination, int cout, Type_service type_service, Roles role) {
        this.nom_user = nom_user;
        this.prenom_user = prenom_user;
        this.email = email;
        this.num_tel = num_tel;
        this.username = username;
        this.password = password;
        this.depart = depart;
        this.destination = destination;
        this.cout = cout;
        this.type_service = type_service;
        this.role = role;
    }

    public int getId_user() {
        return id_user;
    }

    public void setId_user(int id_user) {
        this.id_user = id_user;
    }

    public String getNom_user() {
        return nom_user;
    }

    public void setNom_user(String nom_user) {
        this.nom_user = nom_user;
    }

    public String getPrenom_user() {
        return prenom_user;
    }

    public void setPrenom_user(String prenom_user) {
        this.prenom_user = prenom_user;
    }

    public String getEmail() {
        return email;
    }

    public void setEmail(String email) {
        this.email = email;
    }

    public int getNum_tel() {
        return num_tel;
    }

    public void setNum_tel(int num_tel) {
        this.num_tel = num_tel;
    }

    public String getUsername() {
        return username;
    }

    public void setUsername(String username) {
        this.username = username;
    }

    public String getPassword() {
        return password;
    }

    public void setPassword(String password) {
        this.password = password;
    }

    public String getDepart() {
        return depart;
    }

    public void setDepart(String depart) {
        this.depart = depart;
    }

    public String getDestination() {
        return destination;
    }

    public void setDestination(String destination) {
        this.destination = destination;
    }

    public int getCout() {
        return cout;
    }

    public void setCout(int cout) {
        this.cout = cout;
    }

    public Type_service getType_service() {
        return type_service;
    }

    public void setType_service(Type_service type_service) {
        this.type_service = type_service;
    }

    public Roles getRole() {
        return role;
    }

    public void setRole(Roles role) {
        this.role = role;
    }

    @Override
    public String toString() {
        return "Utilisateur{" + "id_user=" + id_user + ", nom_user=" + nom_user + ", prenom_user=" + prenom_user + ", email=" + email + ", num_tel=" + num_tel + ", username=" + username + ", password=" + password + ", depart=" + depart + ", destination=" + destination + ", cout=" + cout + ", type_service=" + type_service + ", role=" + role + '}'+"\n";
    }
   
   
   
    
    
    

    
   
   
    
}
