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


public class Proposant extends Utilisateur{
    
      public enum Type_service{
    COVOITURAGE,LIVRAISON;
}
    private String depart;
   private String destination;
     private int cout;
    
}
