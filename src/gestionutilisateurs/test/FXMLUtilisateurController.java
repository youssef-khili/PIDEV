/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package gestionutilisateurs.test;

import java.net.URL;
import java.util.ResourceBundle;
import javafx.event.ActionEvent;
import javafx.fxml.FXML;
import javafx.fxml.Initializable;
import javafx.scene.control.Button;
import javafx.scene.control.TextField;
import gestionutilisateurs.entites.Utilisateur;
import gestionutilisateur.services.ServiceUtilisateur;
import gestionutilisateur.services.Service_mail;
import gestionutilisateurs.entites.Utilisateur.Roles;
import gestionutilisateurs.entites.Utilisateur.Type_service;
import java.io.IOException;
import java.sql.SQLException;
import java.util.logging.Level;
import java.util.logging.Logger;
import java.util.stream.Collectors;
import javafx.fxml.FXMLLoader;
import javafx.scene.Parent;
import javafx.scene.control.ComboBox;
import javafx.scene.control.Label;

/**
 * FXML Controller class
 *
 * @author khili youssef
 */
public class FXMLUtilisateurController implements Initializable {

    @FXML
    private TextField TFNom;
    @FXML
    private TextField TFPrenom;
    @FXML
    private TextField TFEmail;
    @FXML
    private TextField TFUsername;
    @FXML
    private TextField TFPassword;
    @FXML
    private TextField TFDepart;
    @FXML
    private TextField TFDestination;
    @FXML
    private TextField TFCout;
    @FXML
    private Button sinscrire;
    private ServiceUtilisateur su;
    @FXML
    private ComboBox<Type_service> CBTypeservice;
    @FXML
    private ComboBox<Roles> CBRole;
    @FXML
    private TextField TFNum_tel;
    private Label LShow;
    @FXML
    private Button retourlogin;
    
     Service_mail srvmail = new Service_mail();
     

    /**
     * Initializes the controller class.
     */
    @Override
    public void initialize(URL url, ResourceBundle rb) {
        
        su =new ServiceUtilisateur();
        // TODO
        
        CBTypeservice.getItems().setAll(Type_service.values());
        CBRole.getItems().setAll(Roles.values());
    }    

    @FXML
    private void AjoutUtilisateur() {
        Utilisateur u = new Utilisateur();
        u.setNom_user(TFNom.getText());
        u.setPrenom_user(TFPrenom.getText());
        u.setDepart(TFDepart.getText());
        u.setDestination(TFDestination.getText());
        u.setEmail(TFEmail.getText());
        u.setPassword(TFPassword.getText());
        u.setUsername(TFUsername.getText());
        u.setCout(Integer.parseInt(TFCout.getText()));
        u.setRole(CBRole.getValue());
        u.setType_service(CBTypeservice.getValue());
        u.setNum_tel(Integer.parseInt(TFNum_tel.getText()));
        
        
      
        su.ajouter(u);
        srvmail.send_mail("youssef.kehili@esprit.tn", TFUsername.getText());
        
       
    }

    @FXML
    private void retourlogin(ActionEvent event) throws IOException {
        
        Parent root=FXMLLoader.load(getClass().getResource("FXMLLogin.fxml"));
                retourlogin.getScene().setRoot(root);
    }

   
}
//
//    private void AfficheUtilisateur(ActionEvent event) {
//       
//            
//            try {
//            
//            
//                LShow.setText(su.afficher().stream().map(Object::toString).collect(Collectors.joining("")));
//            
//            
//            } catch (SQLException ex) {
//            }
//            
//
//        
//    }
//    
//}
