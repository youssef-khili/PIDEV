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
import gestion.livraison.entities.livraison;
import gestion.livraison.utils.Myconnexion;

/**
 *
 * @author User
 */
public class Servicelivraison implements IService<livraison>{
    Connection cnx;
    
    public Servicelivraison (){
        cnx = Myconnexion.getInstance().getCnx();
    }
    @Override
    public void ajouter(livraison t) {
        Statement st;
        try {
            st = cnx.createStatement();
       String query ="INSERT INTO `livraison`( `depart`, `arrive`,`type_objet`,`tarif`, `emplacement_et_etat`, `poids_unitaire` ) VALUES ('"+t.getDepart()+"','"+t.getArrive()+"','"+t.getType_objet()+"','"+t.getTarif()+"','"+t.getEmplacement_et_etat()+"','"+t.getPoids_unitaire()+"')";
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
    public void supprimer(livraison t) {
       Statement st;
        try {
            st = cnx.createStatement();
            String query ="DELETE FROM livraison WHERE id_liv='"+t.getId_liv()+"'";
      
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
    public void modifier(livraison t) {
         Statement st;
        try {
            st = cnx.createStatement();
            String query ="UPDATE `livraison` SET `depart`='"+t.getDepart()+"',`arrive`='"+t.getArrive()+"',`tarif`='"+t.getTarif()+"',`emplacement_et_etat`='"+t.getEmplacement_et_etat()+"' WHERE `livraison`.`id_liv`='"+t.getId_liv()+"'";
      
            st.executeUpdate(query);
        
            
            } catch (SQLException ex) {
            System.out.println(ex.getMessage());
            }
            }

    @Override
        public List<livraison> afficher() throws SQLException {
    Statement stm = cnx.createStatement();
    List<livraison> lv = new ArrayList<>();
    
    String query = "SELECT * FROM livraison";
        ResultSet rs= stm.executeQuery(query);
        while (rs.next()){
            livraison l = new livraison();
        l.setId_liv(rs.getInt("id_liv"));
        l.setDepart(rs.getString("depart"));
        l.setArrive(rs.getString("arrive"));
        l.setType_objet(rs.getString("type_objet"));
        l.setEmplacement_et_etat(rs.getString("emplacement_et_etat"));
        l.setTarif(rs.getInt("tarif"));
        l.setPoids_unitaire(rs.getInt("poids_unitaire"));
        lv.add(l);
        }
             return lv;
    }
   
}
