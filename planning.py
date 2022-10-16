# -*- coding: utf-8 -*-
"""
Created on Sat Oct 15 19:38:01 2022

@author: maria
"""

import csv
import numpy as np
import pandas as pd

fichier=open(r"C:\Users\maria\Documents\HH\RDV réservés(1).csv")

RDV=pd.read_csv(fichier, delimiter=';', header=2)


RDV.iloc[:, 0].replace("BESANCON - don de sang", "sang", inplace=True)
RDV.iloc[:, 0].replace("BESANCON - don de plasma", "plasma", inplace=True)
RDV.iloc[:, 0].replace("BESANCON - don de plaquettes", "plaquettes", inplace=True)
RDV = RDV[["Nom collecte", "Heure du rendez-vous"]]
RDV["numero"] = range(1, RDV.shape[0]+1)

RDV["Heure du rendez-vous"]=RDV["Heure du rendez-vous"].apply(lambda x:(int(x[0:2]))*60+int(x[3:5]))
RDV["Heure du rendez-vous"]=RDV["Heure du rendez-vous"].apply(lambda x:int(x))

   

def planning(DataFrame):
    plan=np.zeros((14,551))
    HeureDebut=8*60+30
    rows = len(DataFrame.axes[0])
    
    #planning médecin
    for k in range (0, rows-1):
             
        #Si le rendez vous est un plaquette
        if DataFrame.iloc[k, 0]=="plaquettes":
            
        #On vérifie si le créneau est dispo
            f=0
            compteur = 0
            while compteur<7:
            
                if plan[0][DataFrame.iloc[k,1]+5-HeureDebut+f]!=0:
                    compteur=0
                else : 
                    compteur+=1
                           
                f+=1
        
            i=0
            while i < 7:
                plan[0][DataFrame.iloc[k,1]+5-HeureDebut+i+f-7]=DataFrame.iloc[k,2]
                i+=1
            
        
        #si le RVD est un plasma --> priorité plaquette
        elif DataFrame.iloc[k,0]=="plasma":
            j=1
            TempsAttente=0
            while (DataFrame.iloc[k+j,1]-DataFrame.iloc[k,1]<=5) and (k+j<rows):
                
                if DataFrame.iloc[k+j,0]=="plaquettes":
                    TempsAttente+=DataFrame.iloc[k+j,1]-DataFrame.iloc[k+j-1,1]+7
                j+=1
            
            
    #On vérifie si le créneau est dispo
            f=0
            compteur = 0
            while compteur<7:
                if TempsAttente!=0 :
                    if plan[0][DataFrame.iloc[k,1]+TempsAttente-HeureDebut+f]!=0:
                        compteur=0
                    else : 
                        compteur+=1
                   
                else : 
                    if plan[0][DataFrame.iloc[k,1]-HeureDebut+5+f]!=0:
                        compteur=0
                    else : 
                        compteur+=1
                f+=1
                      
                    
            i=0
            while i < 7:    
                if TempsAttente!=0 :
                    plan[0][DataFrame.iloc[k,1]+TempsAttente-HeureDebut+i+f]=DataFrame.iloc[k,2]
                else : 
                    
                    plan[0][DataFrame.iloc[k,1]-HeureDebut+5+f]=DataFrame.iloc[k,2]
                i+=1
                        
        # si RDV sang --> priorité PL et PLQ 
        else :
            j=1
            TempsAttente=0
           # print(type(DataFrame.iloc[1,k+j]))
            
            while DataFrame.iloc[k+j,1]-DataFrame.iloc[k,1]<=5 and k+j<rows:
                if  DataFrame.iloc[k+j,0]!="sang":
                    TempsAttente+=DataFrame.iloc[k+j,1]-DataFrame.iloc[k+j-1,1]+7
                j+=1                    
            
            #on vérifie si créneau dispo
            f=0
            compteur = 0
            while compteur<7:
                if TempsAttente!=0 :
                    if plan[0][DataFrame.iloc[k,1]+TempsAttente-HeureDebut+f]!=0:
                        compteur=0
                    else : 
                        compteur+=1
                   
                else : 
                    if plan[0][DataFrame.iloc[k,1]+5-HeureDebut+f]!=0:
                        compteur=0
                    else : 
                        compteur+=1
                f+=1
                
            i=0
            while i <7:
                if TempsAttente!=0 :
                    plan[0][DataFrame.iloc[k,1]+TempsAttente-HeureDebut+i+f]=DataFrame.iloc[k,2]
                else:
                    plan[0][DataFrame.iloc[k,1]-HeureDebut+i+5+f]=DataFrame.iloc[k,2]
                i+=1
            
    return(plan)
 
          

def tri_concatenation(L, mat):
    N = len(L.axes[0])
   
    for n in range(1,N-1,-1):
        max= P.idxmax(columns=1, skipna=True)
        for i in range(0,3):
            mat[i][n]=L[max,i]        
    return(mat)

    
def prio(DataFrame):
    rows = len(DataFrame.axes[0])
    for k in range (0, rows):
        if DataFrame.iloc[k, 0]=="plaquettes":
            DataFrame.iloc[k, 1]-=9
        elif DataFrame.iloc[k, 0]=="plasma":
            DataFrame.iloc[k, 1]-=8
    return (DataFrame)



rows = len(RDV.axes[0])
matrice=np.zeros((rows, 3))
matrice=tri_concatenation(RDV, matrice)
print(matrice)


