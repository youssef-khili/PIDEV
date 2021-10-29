/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package gestion.livraison.test;

import java.net.URL;
import java.util.ResourceBundle;
import javafx.event.ActionEvent;
import javafx.fxml.FXML;
import javafx.fxml.Initializable;
import javafx.scene.control.TextField;
import gestion.livraison.entities.livreur;
import gestion.livraison.services.servicelivreur;
import java.io.IOException;
import java.sql.SQLException;
import java.util.logging.Level;
import java.util.logging.Logger;
import javafx.collections.FXCollections;
import javafx.scene.control.TableColumn;
import javafx.scene.control.TableView;
import javafx.scene.control.cell.PropertyValueFactory;
import javafx.scene.input.MouseEvent;
import java.util.ArrayList;
import java.util.List;
import javafx.collections.ObservableList;
import javafx.event.EventHandler;
import javafx.fxml.FXMLLoader;
import javafx.geometry.Pos;
import javafx.scene.Node;
import javafx.scene.Parent;
import javafx.scene.Scene;
import javafx.stage.Stage;
import javafx.util.Duration;
import org.controlsfx.control.Notifications;
/**
 * FXML Controller class
 *
 * @author User
 */
public class FXMLlivreurController implements Initializable {

    @FXML
    private TextField LIVnom;
    @FXML
    private TextField LIVprenom;
    @FXML
    private TextField LIVcin;
    @FXML
    private TextField LIVtel;
    @FXML
    private TextField LIVrate;
 
    @FXML
    private TableView<livreur> LIVtab;
    @FXML
    private TableColumn<livreur,String> COLnom;
    @FXML
    private TableColumn<livreur, String> COLprenom;
    @FXML
    private TableColumn<livreur, Integer> COLcin;
    @FXML
    private TableColumn<livreur, Integer> COLtel;
    @FXML
    private TableColumn<livreur, String> COLrate;
    private boolean update;
    String query = null;
    @FXML
    private TableColumn<livreur, Integer> COLid_liv;


    @Override
    public void initialize(URL url, ResourceBundle rb) {
        
        COLnom.setCellValueFactory(new PropertyValueFactory<>("nom"));
        COLprenom.setCellValueFactory(new PropertyValueFactory<>("prenom"));
        COLcin.setCellValueFactory(new PropertyValueFactory<>("cin"));
        COLtel.setCellValueFactory(new PropertyValueFactory<>("num_tel"));
        COLrate.setCellValueFactory(new PropertyValueFactory<>("rate"));
        
        servicelivreur liv = new  servicelivreur();
        List<livreur> list = new ArrayList<>();
        try {
             liv.afficher();
            
        } catch (SQLException ex) {
            Logger.getLogger(FXMLlivreurController.class.getName()).log(Level.SEVERE, null, ex);
        }
        ObservableList<livreur> oblistVeh = FXCollections.observableArrayList(list);
        LIVtab.setItems(oblistVeh);
    }    
    
    
    void setTextField( String nom, String prenom, int num_tel, int cin, int rate) {

        LIVnom.setText(nom);
        LIVprenom.setText(prenom);
        LIVtel.setText(String.valueOf(num_tel));
        LIVcin.setText(String.valueOf(cin));
        LIVrate.setText(String.valueOf(rate));

    }
    @FXML
    private void Ajouterlivreur(ActionEvent event) {
        livreur l = new livreur();
         servicelivreur lv = new servicelivreur();
  
        l.setNom(LIVnom.getText());
        l.setPrenom(LIVprenom.getText());
        l.setNum_tel(Integer.parseInt(LIVtel.getText()));
        l.setCin(Integer.parseInt(LIVcin.getText()));
        l.setRate(Integer.parseInt(LIVrate.getText()));
        lv.ajouter(l);
        Notifications notificationsBuilder = Notifications.create()
                .title("NOTIFICATION")
                .text("livreur ajouté")
                .graphic(null)
                .hideAfter(Duration.seconds(10))
                .position(Pos.TOP_LEFT).onAction(new EventHandler<ActionEvent>() {
            @Override
            public void handle(ActionEvent event) {
                System.out.print("clicked on notification");
                }
        });
        notificationsBuilder.showConfirm();
        
        
    }
    @FXML
    private void Supprimerlivreur(ActionEvent event) {
         servicelivreur sl = new  servicelivreur();
        sl.supprimer(LIVtab.getSelectionModel().getSelectedItem());
        LIVnom.setText("");
        LIVprenom.setText("");
        LIVtel.setText("");
        LIVcin.setText("");
        LIVrate.setText("");
    }

    @FXML
    private void Modifierlivreur(ActionEvent event) {

         livreur v = LIVtab.getSelectionModel().getSelectedItem();
        servicelivreur ve;
        ve = new servicelivreur();
          v.setNom(LIVnom.getText());
        v.setPrenom(LIVprenom.getText());
        v.setNum_tel(Integer.parseInt(LIVtel.getText()));
        v.setCin(Integer.parseInt(LIVcin.getText()));
        v.setRate(Integer.parseInt(LIVrate.getText()));
             ve.modifier(v);
        }
    
    
   int index=-1;
 @FXML
    void getSelected(MouseEvent event) {
        
  index = LIVtab.getSelectionModel().getSelectedIndex();
        if(index<=-1){
            return;
        }
        
        LIVnom.setText(LIVtab.getSelectionModel().getSelectedItem().getNom());
        LIVprenom.setText(LIVtab.getSelectionModel().getSelectedItem().getPrenom());
        LIVcin.setText(String.valueOf(LIVtab.getSelectionModel().getSelectedItem().getCin()));
        LIVtel.setText(String.valueOf(LIVtab.getSelectionModel().getSelectedItem().getNum_tel()));   
        LIVrate.setText(String.valueOf(LIVtab.getSelectionModel().getSelectedItem().getRate()));
}
    @FXML
    private void Afficherlivreur(ActionEvent event) {
        COLid_liv.setCellValueFactory(new PropertyValueFactory<>("id_livreur"));
        COLnom.setCellValueFactory(new PropertyValueFactory<>("nom"));
        COLprenom.setCellValueFactory(new PropertyValueFactory<>("prenom"));
        COLcin.setCellValueFactory(new PropertyValueFactory<>("cin"));
        COLtel.setCellValueFactory(new PropertyValueFactory<>("num_tel"));
         COLrate.setCellValueFactory(new PropertyValueFactory<>("rate"));
        servicelivreur liv = new  servicelivreur();
        List <livreur> list = new ArrayList<>();
        try {
           list= liv.afficher();

        } catch (SQLException ex) {
            Logger.getLogger(FXMLlivreurController.class.getName()).log(Level.SEVERE, null, ex);
        }
        ObservableList<livreur> oblistv = FXCollections.observableArrayList(list);
        LIVtab.setItems(oblistv);
    }

    @FXML
    private void buttonlivraison(ActionEvent event) {
        try{
        Parent root = FXMLLoader.load(getClass().getResource("FXMLlivraison.fxml"));
        
        Scene scene = new Scene(root);
        Stage stage = (Stage)((Node)event.getSource()).getScene().getWindow();
        stage.setScene(scene);
        stage.show();
        
        }catch(IOException e){
            System.out.println(e.getMessage());
        }
    }
    }

