/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package gestion.livraison.services;

import java.sql.Connection;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import java.util.ArrayList;
import java.util.List;
import gestion.livraison.entities.livreur;
import gestion.livraison.utils.Myconnexion;

/**
 *
 * @author User
 */
public class servicelivreur implements IService<livreur>{
    Connection cnx;
    
    public servicelivreur(){
        cnx = Myconnexion.getInstance().getCnx ();
    }
    
    @Override
    public void ajouter(livreur t) {
        Statement st;
        try {
            st = cnx.createStatement();
       String query ="INSERT INTO `livreur`( `nom`, `prenom`,`num_tel`, `cin`, `rate` ) VALUES ('"+t.getNom()+"','"+t.getPrenom()+"','"+t.getNum_tel()+"','"+t.getCin()+"','"+t.getRate()+"')";
        st.executeUpdate(query);

        } catch (SQLException ex) {
            System.out.println(ex.getMessage());
        }
        
    
    }

    /**
     *
     * @param t
     */
    @Override
    public void supprimer(livreur t) {
       Statement st;
        try {
            st = cnx.createStatement();
            String query ="DELETE FROM livreur WHERE id_liv='"+t.getId_livreur()+"'";
      
            st.executeUpdate(query);
        
        
        } catch (SQLException ex) {
            System.out.println(ex.getMessage());
        }
    }

    /**
     *
     * @param t
     */
    @Override
    public void modifier(livreur t) {
         Statement st;
        try {
            st = cnx.createStatement();
            String query ="UPDATE `livreur` SET `nom`='"+t.getNom()+"',`prenom`='"+t.getPrenom()+"',`num_tel`='"+t.getNum_tel()+"',`cin`='"+t.getCin()+"',`rate`='"+t.getRate()+"' WHERE `id_livreur`='"+t.getId_livreur()+"'";      
            st.executeUpdate(query);
        
            
            } catch (SQLException ex) {
            System.out.println(ex.getMessage());
            }
            }

    @Override
    public List<livreur> afficher() throws SQLException {
    Statement stm = cnx.createStatement();
    List<livreur> lv = new ArrayList<>();
    
         String query = "SELECT * FROM livreur";
        ResultSet rs= stm.executeQuery(query);
        while (rs.next()){
            livreur liv = new livreur();
        liv.setId_livreur(rs.getInt("id_livreur"));
        liv.setNom(rs.getString("nom"));
        liv.setPrenom(rs.getString("prenom"));
        liv.setNum_tel(rs.getInt("num_tel"));
        liv.setCin(rs.getInt("cin"));
        liv.setRate(rs.getInt("rate"));
       
        lv.add(liv);
        }
    return lv;
    }
}