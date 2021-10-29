/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package gestion.livraison.services;

import java.sql.SQLException;
import java.util.List;

/**
 *
 * @author User
 * @param <T>
 */
public interface IService<T> {
    
public void ajouter(T t);
public List<T> afficher()throws SQLException;
public void supprimer(T t);
public void modifier(T t);

}
