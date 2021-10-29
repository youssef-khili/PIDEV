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
import javafx.fxml.FXMLLoader;
import javafx.fxml.Initializable;
import javafx.scene.control.PasswordField;
import javafx.scene.control.TextField;
import gestionutilisateur.services.ServiceUtilisateur;
import gestionutilisateur.services.Service_mail;
import gestionutilisateurs.entites.Proposant;
import gestionutilisateurs.entites.Utilisateur;
import static gestionutilisateurs.entites.Utilisateur.Roles;
import java.io.IOException;
import java.sql.SQLException;
import javafx.scene.Node;
import javafx.scene.Parent;
import javafx.scene.Scene;
import javafx.scene.control.Button;
import javafx.stage.Stage;
import javax.management.relation.Role;
import javax.swing.JOptionPane;

/**
 * FXML Controller class
 *
 * @author khili youssef
 */
public class FXMLLoginController implements Initializable {

    @FXML
    private TextField TFUsername;
    @FXML
    private PasswordField TFPassword;
    ServiceUtilisateur su = new ServiceUtilisateur ();
    Utilisateur u=new Utilisateur();
    @FXML
    private Button loginverf;
    @FXML
    private Button btnsignup;
    
    
 
    
    /**
     * Initializes the controller class.
     */
    @Override
    public void initialize(URL url, ResourceBundle rb) {
        // TODO
    }    

    @FXML
    private void LoginVerif(ActionEvent event) throws IOException, SQLException {
      
       if (su.logInVerif(TFUsername.getText(), TFPassword.getText())){
           
           u=su.rechercheParUsername(TFUsername.getText());
           if(u.getRole().equals(Utilisateur.Roles.RESPONSABLE_COVOIT)){
                        Parent root=FXMLLoader.load(getClass().getResource("FXMLResponsable_covit.fxml"));
                        loginverf.getScene().setRoot(root);
                }else if(u.getRole().equals(Utilisateur.Roles.ADMIN)){
                        Parent root=FXMLLoader.load(getClass().getResource("FXMLEspaceAdmin.fxml"));
                        loginverf.getScene().setRoot(root);
                }else if(u.getRole().equals(Utilisateur.Roles.RESPONSABLE_LIV)){
                    
                        Parent root=FXMLLoader.load(getClass().getResource("FXMLResponsable_livraison.fxml"));
                        loginverf.getScene().setRoot(root);
                        
                         
                        
                        
                }else if(u.getRole().equals(Utilisateur.Roles.RESPONSABLE_ACT)){
                    Parent root=FXMLLoader.load(getClass().getResource("FXMLResponsable_act.fxml"));
                    loginverf.getScene().setRoot(root);
                       
                       }
                else if(u.getRole().equals(Utilisateur.Roles.RESPONSABLE_PUB)){
                    Parent root=FXMLLoader.load(getClass().getResource("FXMLResponsable_pub.fxml"));
                    loginverf.getScene().setRoot(root);
                       
                       }
                else if(u.getRole().equals(Utilisateur.Roles.RESPONSABLE_TRANS_PUBLIC)){
                    Parent root=FXMLLoader.load(getClass().getResource("FXMLResponsable_transp_public.fxml"));
                    loginverf.getScene().setRoot(root);
                       }
                
           
                       
           }
     
       
       
                 else {
       
              JOptionPane.showMessageDialog(null,"login failed");
       }
          
        
    }
           
    

    @FXML
    private void sinscrire(ActionEvent event) throws IOException {
       
                Parent root=FXMLLoader.load(getClass().getResource("FXMLUtilisateur.fxml"));
                btnsignup.getScene().setRoot(root);
               
        
    }
    
}
