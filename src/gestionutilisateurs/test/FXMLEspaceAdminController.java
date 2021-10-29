/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package gestionutilisateurs.test;

import gestionutilisateur.services.ServiceUtilisateur;
import gestionutilisateurs.entites.Utilisateur;
import java.io.IOException;
import java.net.URL;
import java.sql.SQLException;
import java.util.List;
import java.util.Observable;
import java.util.ResourceBundle;
import java.util.logging.Level;
import java.util.logging.Logger;
import javafx.collections.FXCollections;
import javafx.collections.ObservableList;
import javafx.event.ActionEvent;
import javafx.fxml.FXML;
import javafx.fxml.FXMLLoader;
import javafx.fxml.Initializable;
import javafx.scene.Parent;
import javafx.scene.Scene;
import javafx.scene.control.Button;
import javafx.scene.control.Label;
import javafx.scene.control.TableColumn;
import javafx.scene.control.TableView;
import javafx.scene.control.TextField;
import javafx.scene.control.cell.PropertyValueFactory;
import javafx.stage.Stage;

/**
 * FXML Controller class
 *
 * @author khili youssef
 */
public class FXMLEspaceAdminController implements Initializable {

    @FXML
    private TableColumn<Utilisateur,String> nom;
    @FXML
    private TableColumn<Utilisateur,String> prenom;
    @FXML
    private TableColumn<Utilisateur,String> email;
    @FXML
    private TableColumn<Utilisateur,Integer> telephone;
    @FXML
    private TableColumn<Utilisateur,String> username;
    @FXML
    private TableColumn<Utilisateur,String> password;
    @FXML
    private TableColumn<Utilisateur,String> destination;
    @FXML
    private TableColumn<Utilisateur,Integer> cout;
    @FXML
    private TableColumn<Utilisateur,String> type;
    @FXML
    private TableColumn<Utilisateur,String> role;
    @FXML
    private TableView<Utilisateur> tableUtil;
    @FXML
    private TableColumn<Utilisateur,String> depart;
    ServiceUtilisateur su = new ServiceUtilisateur();
    
    ObservableList<Utilisateur> list= FXCollections.observableArrayList();
    @FXML
    private TableColumn<Utilisateur, Integer> id_user;
    @FXML
    private Button Archiver;
    @FXML
    private Button btnajouter;
    @FXML
    private TextField txtrech;
    @FXML
    private Button rech;
    @FXML
    private Label labelll;
    @FXML
    private Button refreshhh;
    

    /**
     * Initializes the controller class.
     */
    @Override
    public void initialize(URL url, ResourceBundle rb) {
       
        RefreshList();
          
       
        
        
       
    }    

    @FXML
    private void ArchiverUtil(ActionEvent event) {
        try {
            int id_user=tableUtil.getSelectionModel().getSelectedItem().getId_user();
            su.archiver(id_user);
        } catch (SQLException ex) {
            Logger.getLogger(FXMLEspaceAdminController.class.getName()).log(Level.SEVERE, null, ex);
        }
        RefreshList();
        
        
    }
    
    public void RefreshList(){
  
         try {
            list.clear();
            ServiceUtilisateur su = new ServiceUtilisateur();
            list = FXCollections.observableArrayList(su.afficher());
            
            // TODO
            nom.setCellValueFactory(new PropertyValueFactory<>("nom_user"));
            prenom.setCellValueFactory(new PropertyValueFactory<>("prenom_user"));
            email.setCellValueFactory(new PropertyValueFactory<>("email"));
            telephone.setCellValueFactory(new PropertyValueFactory<>("num_tel"));
            username.setCellValueFactory(new PropertyValueFactory<>("username"));
            password.setCellValueFactory(new PropertyValueFactory<>("password"));
            destination.setCellValueFactory(new PropertyValueFactory<>("destination"));
            depart.setCellValueFactory(new PropertyValueFactory<>("depart"));
            cout.setCellValueFactory(new PropertyValueFactory<>("cout"));
            type.setCellValueFactory(new PropertyValueFactory<>("type_service"));
            role.setCellValueFactory(new PropertyValueFactory<>("role"));
            id_user.setCellValueFactory(new PropertyValueFactory<>("id_user"));
             tableUtil.setItems(list);
        } catch (SQLException ex) {
            Logger.getLogger(FXMLEspaceAdminController.class.getName()).log(Level.SEVERE, null, ex);
        }
    }

    @FXML
    private void ajouterutili(ActionEvent event) throws IOException {
       FXMLLoader fxmlLoader = new FXMLLoader(getClass().getResource("FXMLUtilisateur.fxml"));
        Parent root1 = (Parent) fxmlLoader.load();
        Stage stage = new Stage();
        stage.setScene(new Scene(root1));
        stage.show();
        
    }

    @FXML
    private void rechercherutili(ActionEvent event) {
        
         try {
            labelll.setText(su.rechercheParId(Integer.parseInt(txtrech.getText())).toString());
        } catch (SQLException ex) {
            Logger.getLogger(FXMLEspaceAdminController.class.getName()).log(Level.SEVERE, null, ex);
        }
        
    }

    @FXML
    private void refresh(ActionEvent event) {
        RefreshList();
    }
    
    

    
    
    
}
