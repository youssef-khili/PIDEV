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
import gestion.livraison.entities.livraison;
import gestion.livraison.services.Servicelivraison;
import java.io.IOException;
import java.sql.SQLException;
import java.util.ArrayList;
import java.util.List;
import java.util.logging.Level;
import java.util.logging.Logger;
import javafx.collections.FXCollections;
import javafx.collections.ObservableList;
import javafx.event.EventHandler;
import javafx.fxml.FXMLLoader;
import javafx.geometry.Pos;
import javafx.scene.Node;
import javafx.scene.Parent;
import javafx.scene.Scene;
import javafx.scene.control.TableColumn;
import javafx.scene.control.TableView;
import javafx.scene.control.cell.PropertyValueFactory;
import javafx.scene.input.MouseEvent;
import javafx.stage.Stage;
import javafx.util.Duration;
import org.controlsfx.control.Notifications;

/**
 * FXML Controller class
 *
 * @author User
 */
public class FXMLlivraisonController implements Initializable {

    @FXML
    private TextField TFdepart;
    @FXML
    private TextField TFarrive;
    @FXML
    private TextField TFtarif;
    @FXML
    private TextField TFtype;
    @FXML
    private TextField TFemplacement;
    @FXML
    private TextField TFpoid;

    @FXML
    private TableView<livraison> LVtab;
    @FXML
    private TableColumn<livraison, String> COLdepart;
    @FXML
    private TableColumn<livraison, String> COLarrive;
    @FXML
    private TableColumn<livraison, Integer> COLtarif;
    @FXML
    private TableColumn<livraison, String> COLtype;
    @FXML
    private TableColumn<livraison, String> COLemplacement;
    @FXML
    private TableColumn<livraison, Integer> COLpoids;
    
    private boolean update;
    String query = null;
    @FXML
    private TableColumn<livraison, Integer> COLid_livraison;
    
    @Override
    public void initialize(URL url, ResourceBundle rb) {
        COLdepart.setCellValueFactory(new PropertyValueFactory<>("depart"));
        COLarrive.setCellValueFactory(new PropertyValueFactory<>("arrive"));
        COLtarif.setCellValueFactory(new PropertyValueFactory<>("tarif"));
        COLtype.setCellValueFactory(new PropertyValueFactory<>("type_objet"));
        COLemplacement.setCellValueFactory(new PropertyValueFactory<>("emplacement_et_etat"));
        COLpoids.setCellValueFactory(new PropertyValueFactory<>("poids"));
        
        Servicelivraison lv = new  Servicelivraison();
        List<livraison> list = new ArrayList<>();
        try {
            lv.afficher();
        } catch (SQLException ex) {
            Logger.getLogger(FXMLlivraisonController.class.getName()).log(Level.SEVERE, null, ex);
        }
        ObservableList<livraison> oblistV = FXCollections.observableArrayList(list);
        LVtab.setItems(oblistV);
    }    

    void setTextField( String depart, String arrive, int tarif, String type_objet, String emplacement_et_etat, int poids) {

        TFdepart.setText(depart);
        TFarrive.setText(arrive);
        TFtarif.setText(String.valueOf(tarif));
        TFtype.setText(type_objet);
        TFemplacement.setText(emplacement_et_etat);
        TFpoid.setText(String.valueOf(poids));

    }
    
    @FXML
    private void Ajouterlivraison(ActionEvent event) {
        livraison l = new livraison();
        Servicelivraison lv = new Servicelivraison();
        
        l.setDepart(TFdepart.getText());
        l.setArrive(TFarrive.getText());
        l.setTarif(Integer.parseInt(TFtarif.getText()));
        l.setType_objet(TFtype.getText());
        l.setArrive(TFemplacement.getText());
        l.setPoids_unitaire(Integer.parseInt(TFpoid.getText()));
        lv.ajouter(l);
        Notifications notificationsBuilder = Notifications.create()
                .title("NOTIFICATION")
                .text("livraison ajouté")
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
    private void Supprimerlivraison(ActionEvent event) {
         Servicelivraison lv = new  Servicelivraison();
        lv.supprimer(LVtab.getSelectionModel().getSelectedItem());

        TFdepart.setText("");
        TFarrive.setText("");
        TFtarif.setText("");
        TFtype.setText("");
        TFemplacement.setText("");
        TFpoid.setText("");
    }

    @FXML
    private void Modifierlivraison(ActionEvent event) {
        
        livraison v = LVtab.getSelectionModel().getSelectedItem();
        Servicelivraison ve;
        ve = new Servicelivraison();
        v.setDepart(TFdepart.getText());
        v.setArrive(TFarrive.getText());
        v.setTarif(Integer.parseInt(TFtarif.getText()));
        v.setType_objet(TFtype.getText());
        v.setEmplacement_et_etat(TFemplacement.getText());
        v.setPoids_unitaire(Integer.parseInt(TFpoid.getText()));

             ve.modifier(v);
    }

       int index=-1;
       
    @FXML
    private void getSelected(MouseEvent event) {
        
    index = LVtab.getSelectionModel().getSelectedIndex();
        if(index<=-1){
            return;
        }
        TFdepart.setText(LVtab.getSelectionModel().getSelectedItem().getDepart());
         TFarrive.setText(LVtab.getSelectionModel().getSelectedItem().getArrive());
         TFtarif.setText(String.valueOf(LVtab.getSelectionModel().getSelectedItem().getTarif()));
         TFtype.setText(LVtab.getSelectionModel().getSelectedItem().getType_objet());
         TFemplacement.setText(LVtab.getSelectionModel().getSelectedItem().getEmplacement_et_etat());
         TFpoid.setText(String.valueOf(LVtab.getSelectionModel().getSelectedItem().getPoids_unitaire()));
    }
    @FXML
    private void Afficherlivraison(ActionEvent event) throws SQLException {
        COLid_livraison.setCellValueFactory(new PropertyValueFactory<>("id_liv"));
        COLdepart.setCellValueFactory(new PropertyValueFactory<>(" depart"));
        COLarrive.setCellValueFactory(new PropertyValueFactory<>(" arrive"));
        COLtarif.setCellValueFactory(new PropertyValueFactory<>("tarif"));
        COLtype.setCellValueFactory(new PropertyValueFactory<>("type_objet"));
        COLemplacement.setCellValueFactory(new PropertyValueFactory<>("emplacement_et_etat"));
        COLpoids.setCellValueFactory(new PropertyValueFactory<>("poids_unitaire"));

        Servicelivraison liv = new  Servicelivraison();
        List <livraison> list = new ArrayList<>();
        try {
            list = liv.afficher();
        } catch (SQLException ex) {
            Logger.getLogger(FXMLlivraisonController.class.getName()).log(Level.SEVERE, null, ex);
        }
        ObservableList<livraison> oblistv = FXCollections.observableArrayList(list);
        LVtab.setItems(oblistv);
    }

    @FXML
    private void buttonlivreur(ActionEvent event) {
        try{
        Parent root = FXMLLoader.load(getClass().getResource("FXMLlivreur.fxml"));
        
        Scene scene = new Scene(root);
        Stage stage = (Stage)((Node)event.getSource()).getScene().getWindow();
        stage.setScene(scene);
        stage.show();
        
        }catch(IOException e){
            System.out.println(e.getMessage());
        }
    }
}