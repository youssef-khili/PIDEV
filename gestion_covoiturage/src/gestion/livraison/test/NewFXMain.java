/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package gestion.livraison.test;

import java.io.IOException;
import javafx.application.Application;

import javafx.fxml.FXMLLoader;
import javafx.scene.Parent;
import javafx.scene.Scene;
import javafx.stage.Stage;

/**
 *
 * @author User
 */
public class NewFXMain extends Application {
  
    
    @Override
    public void start(Stage stage)  {
        try{
        Parent root = FXMLLoader.load(getClass().getResource("FXMLlivraison.fxml"));
        
        Scene scene = new Scene(root);
        stage.setTitle("livraison");
        stage.setScene(scene);
        stage.show();
        }catch(IOException e){
            System.out.println(e.getMessage());
        }
    }

    /**
     * @param args the command line arguments
     */
    public static void main(String[] args) {
        launch(args);
}
}
