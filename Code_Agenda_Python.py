import numpy as np
Infir1=[1,0,0,0]
Infir2=[2,0,0,0]
Infir3=[3,0,0,0]
def inf(i):
    if i==1:
        return Infir1
    if i==2:
        return Infir2
    if i==3:
        return Infir3
MAT=[]
INF=[]
def nbtache(inf):
    n=0
    for i in range(1,len(inf)):
        if inf[i]!=0:
            n+=1
    return 3-n

Nbtache=[nbtache(Infir1),nbtache(Infir2),nbtache(Infir3)]
Infirmiers=np.array([Infir1,Infir2,Infir3])
TpRestant=np.array([[0,0,0],[0,0,0],[0,0,0]])   
Taches=np.array([[1],[2],[3]])
duree=np.array([15,90,120])    
temps=0
delta=10
litsMax=np.array([[6],[4],[3]])
Variation=np.array([[0,0,0],[0,0,0],[0,0,0]]) 
n=61
Lits=litsMax
def Infdispo(y,n):
    if ((n==2) and (y[1]==0 or y[2]==0 or y[3]==0)): 
        for i in range(1,4): 
            if (y[i]==3): 
                return False 
            return True 
    if ((n==3) and (y[1]==0 or y[2]==0 or y[3]==0)): 
        for i in range(1,4): 
            if y[i]==2:
                return False
            return True 
    if (y[1]!=0 and y[2]!=0 and y[3]!=0): 
         return False
    if (n==1 and (y[1]==0 or y[2]==0 or y[3]==0)):
         return True
def dispoinf():      
    a=False
    if Infdispo(Infir1,tache):
        if Infdispo(Infir2,tache):
            if Infdispo(Infir1,tache):
                a=True
    return a
def dispolit(lit):
    for i in range(len(lit)):
        a=True
        if lit[i]>=litsMax[i]:
            a=False 
    return a
for i in range(1,n): 
    Priorite=np.transpose(np.multiply(Taches,Lits))
    if i > 48: 
        Priorite[Priorite[:,1]==3,:]=[]
    if i > 50: 
        Priorite[Priorite[:,1]==2,:]=[]
    tache=Priorite[1] 

    if dispoinf and dispolit(Lits):
    
        Lits[tache-1]=Lits[tache-1] - 1
        if Infdispo(Infir1,tache):
            for indlibre in range(4):
                if Infir1[indilibre]==0:
                    return indilibre
                Infir1[indlibre]=tache
                Nbtache[0]=Nbtache[0] - 1
                TpRestant[0][indilibre]=duree[tache]
        if Infdispo(Infir2,tache):
            for indlibre in range(4):
                if Infir1[indilibre]==0:
                    return indilibre
                Infir1[indlibre]=tache
                Nbtache[1]=Nbtache[1] - 1
                TpRestant[1][indilibre]=duree[tache]
        if Infdispo(Infir3,tache):
            for indlibre in range(4):
                if Infir1[indilibre]==0:
                    return indilibre
                Infir1[indlibre]=tache
                Nbtache[2]=Nbtache[2] - 1
                TpRestant[2][indilibre]=duree[tache]
        SuperAgenda0=[j for j in range(0,n,temps)]
        Infirmiers=np.array([Infir1,Infir2,Infir3])
    else:
        tache==Priorite[2]
        if dispoinf and dispolit(Lits):
            c=c+1
            Lits[tache-1]=Lits[tache-1] - 1
        if Infdispo(Infir1,tache)
            for indlibre in range(4):
                if Infir1[indilibre]==0:
                    return indilibre
                Infir1[indlibre]=tache
                Nbtache[0]=Nbtache[0] - 1
                TpRestant[0][indilibre]=duree[tache]
        if Infdispo(Infir2,tache)
            for indlibre in range(4):
                if Infir1[indilibre]==0:
                    return indilibre
                Infir1[indlibre]=tache
                Nbtache[1]=Nbtache[1] - 1
                TpRestant[1][indilibre]=duree[tache]
        if Infdispo(Infir3,tache)
            for indlibre in range(4):
                if Infir1[indilibre]==0:
                    return indilibre
                Infir1[indlibre]=tache
                Nbtache[2]=Nbtache[2] - 1
                TpRestant[2][indilibre]=duree[tache]
        SuperAgenda0=[j for j in range(0,n,temps)]
        Infirmiers=np.array([Infir1,Infir2,Infir3])
    temps=temps + delta
    for j in range(1,3):
        for k in range(2,4):
            if TpRestant[j,k] > 0 and (not Infdispo(inf(j)),k != indlibre):
                TpRestant[j,k]=TpRestant[j,k] - delta
    MAT[:,:,:,i]=TpRestant
    LIT[i,:]=Lits
    
    # Actualisation des taches en cours chez chaque infirmier
    if i > 1:
        Variation[:,2:4] = MAT[:,2:4,i]-MAT[:,2:4,i-1]
        for j in range(1,3):
            for k in range(2,4):
                if TpRestant[j,k] <= 0 and Variation[j,k] < 0:
                    TpRestant[j,k]=0
                    tacheFini=Infirmiers[j,k]
                    Infirmiers[j,k]=0
                    Nbtache[j]=Nbtache(j) + 1
                    Lits[tacheFini]=Lits[tacheFini] + 1
    Infir1=Infirmiers[0,:]
    Infir2=Infirmiers[1,:]
    Infir3=Infirmiers[2,:]
    INF[:,:,i]=Infirmiers
    
    ## Conversion du temps en (heures:minutes)
    heure_initial=[8,15]
    
    temps_attente=15
    for i1 in range(1,n):
        t=SuperAgenda0(i1) + temps_attente + heure_initial[1]
        heure_rdv[i1,:]=[heure_initial(1) + floor(t / 60),mod(t,60)]
    
    SuperAgenda=[heure_rdv,SuperAgenda0[:,2]]
    xlswrite('SuperAgenda.xlsx',SuperAgenda)
    
    ## Recherche d'un infirmier pour un prélèvement 
    
def DisponibiliteInf(tache=None,Infirmiers=None,*args,**kwargs):
    varargin = DisponibiliteInf.varargin
    nargin = DisponibiliteInf.nargin
    InfLibres=Infirmiers[Infirmiers[:,end]] > 0    
    InfLibres=np.transpose([InfLibres])
    Infdispo=[]
    if logical_not(isempty(InfLibres)):
        for i in arange(1,size(InfLibres,1)).reshape(-1):
            tachesInf=InfLibres(i,arange(2,4))
            if tache == 2:
                dispoinf=isempty(tachesInf(tachesInf == 3))
                if dispoinf:
                    Infdispo=InfLibres(i,arange())
                    break
            elif tache == 3:
                    dispoinf=isempty(tachesInf(tachesInf == 2))
                    if dispoinf:
                        Infdispo=InfLibres(i,arange())
                        break
            else:
                dispoinf=copy(true)
                if dispoinf:
                    Infdispo=InfLibres(i,arange())
                    break
    
    return dispoinf,Infdispo
    
if __name__ == '__main__':
    pass
    
    ## Recherche d'un lit disponible pour un prélèvement
    
def DisponibiliteLit(tache=None,Lits=None,*args,**kwargs):
    varargin = DisponibiliteLit.varargin
    nargin = DisponibiliteLit.nargin
    if tache == 1 and Lits(tache) > 0:
        dispolit=copy(true)
    elif tache == 2 and Lits(tache) > 0:
            dispolit=copy(true)
    elif tache == 3 and Lits(tache) > 0:
                dispolit=copy(true)
    else:
        dispolit=copy(false)
    
    return dispolit
    
if __name__ == '__main__':
    pass
    