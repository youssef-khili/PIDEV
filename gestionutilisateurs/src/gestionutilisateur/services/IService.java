/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package gestionutilisateur.services;

import gestionutilisateurs.entites.Utilisateur;
import java.sql.SQLException;
import java.util.List;

/**
 *
 * @author khili youssef
 */
public interface IService<T> {
public void ajouter(T t);
public List<T> afficher()throws SQLException;
public void supprimer(int id) throws SQLException;
public void modifier(int id, T t) throws SQLException;
public Utilisateur rechercheParId(int id) throws SQLException;



    
}
