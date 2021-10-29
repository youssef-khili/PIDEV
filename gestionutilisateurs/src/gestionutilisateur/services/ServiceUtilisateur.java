/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package gestionutilisateur.services;

import java.sql.Connection;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import java.util.ArrayList;
import java.util.List;
import java.util.logging.Level;
import java.util.logging.Logger;
import gestionutilisateurs.entites.Utilisateur;
import gestionutilisateurs.entites.Utilisateur.Roles;
import gestionutilisateurs.entites.Utilisateur.Type_service;
import gestionutilisateurs.utils.Myconnexion;

/**
 *
 * @author khili youssef
 */
public class ServiceUtilisateur implements IService<Utilisateur>{
    Connection cnx;
    
    public ServiceUtilisateur (){
        cnx = Myconnexion.getInstance().getCnx();
    }
    @Override
    public void ajouter(Utilisateur u) {
      
        Statement st;
        try {
            st = cnx.createStatement();
       String query ="INSERT INTO `utilisateur`(`id_user`, `nom_user`, `prenom_user`, `email`, `num_tel`, `username`, `password`, `depart`, `destination`, `cout`, `type_service`, `role`) VALUES ('"+u.getId_user()+"','"+u.getNom_user()+"','"+u.getPrenom_user()+"','"+u.getEmail()+"','"+u.getNum_tel()+"','"+u.getUsername()+"','"+u.getPassword()+"','"+u.getDepart()+"','"+u.getDestination()+"','"+u.getCout()+"','"+u.getType_service()+"','"+u.getRole()+"')";
      
        st.executeUpdate(query);
        
        
        } catch (SQLException ex) {
            System.out.println(ex.getMessage());
        }
        
    
    }
    
    @Override
    public List<Utilisateur> afficher() throws SQLException {
    Statement stm = cnx.createStatement();
    List<Utilisateur> lp = new ArrayList<>();
    
    String query = "SELECT * FROM `utilisateur` WHERE 1";
        ResultSet rs= stm.executeQuery(query);
        while (rs.next()){
        Utilisateur u = new Utilisateur();
        u.setId_user(rs.getInt("id_user"));
        u.setNom_user (rs.getString(2));
        u.setPrenom_user(rs.getString("prenom_user"));
        u.setEmail(rs.getString("email"));
        u.setNum_tel(rs.getInt("num_tel"));
        u.setUsername(rs.getString("username"));
        u.setPassword(rs.getString("password"));
        u.setDepart(rs.getString("depart"));
        u.setDestination(rs.getString("destination"));
        u.setCout(rs.getInt("cout"));
        u.setRole(Roles.valueOf(rs.getString("role")));
        u.setType_service(Type_service.valueOf(rs.getString("type_service")));
       
        
        lp.add(u);
        }
            return lp;
    }

    @Override
    public void supprimer(int id_user) {
        Statement stm;
        try{
            stm=cnx.createStatement();
            String query="DELETE FROM `utilisateur` WHERE id_user="+id_user;
            stm.executeUpdate(query);
        }
        catch (SQLException ex) {
            System.out.println(ex.getMessage());
        }
    }
    
    
    public void modifier(int id_user, Utilisateur u ) throws SQLException{
        Statement stm=cnx.createStatement();
        String query="UPDATE `utilisateur` SET `nom_user`='"+u.getNom_user()+"',`prenom_user`='"+u.getPrenom_user()+"',`email`='"+u.getEmail()+"',`username`='"+u.getUsername()+"',`password`='"+u.getPassword()+"' WHERE `id_user`="+id_user;
        stm.executeUpdate(query);
    }

    public Utilisateur rechercheParId(int id_user) throws SQLException{
        
        Statement stm=cnx.createStatement();
        Utilisateur u=new Utilisateur();
        String query="SELECT * FROM `utilisateur` WHERE id_user="+id_user;
        ResultSet rs= stm.executeQuery(query);
        while (rs.next()) {
            u.setId_user(rs.getInt("id_user"));
            u.setNom_user(rs.getString("nom_user"));
            u.setPrenom_user(rs.getString("prenom_user"));
            u.setEmail(rs.getString("Email"));
            u.setNum_tel(rs.getInt("num_tel"));
            u.setUsername(rs.getString("username"));
            u.setPassword(rs.getString("password"));
            u.setDepart(rs.getString("depart"));
            u.setDestination(rs.getString("destination"));
            u.setCout(rs.getInt("cout"));
            u.setRole(Roles.valueOf(rs.getString("role")));
            u.setType_service(Type_service.valueOf(rs.getString("type_service")));  
        }
        return u;
        
        
    }
    
}
