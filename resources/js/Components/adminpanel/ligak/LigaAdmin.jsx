import { usePage } from '@inertiajs/react';
import HeaderAdmin from './HeaderAdmin';
import Liga from './Liga';
import '@/../css/adminpanel/ligak/nagusia.css';
import Footer from '@/Components/aktibitatea/Footer';
import { useState, useEffect } from 'react';


function LigaAdmin(){
    const { ligak = []} = usePage().props;
    const [ligaGuztiak, setLigaGuztiak] = useState([]);

    useEffect(()=>{
        const fetchData = async()=>{
          const response = await fetch('http://10.14.0.235:8000/api/ligak');
          const data = await response.json();
          setLigaGuztiak(data);
        };
        fetchData();
      },[])
    console.log(ligak);
    return(
        <>  
        <div className='dena bg-black'>
            <HeaderAdmin />
            {ligaGuztiak.length > 0 ? 
                ligaGuztiak.map((liga) =>(
                    <Liga liga={liga} />
                )):(
                    <p>Ez daude ligarik</p>
                )   

            }
            </div>
        </>
    )
}
export default LigaAdmin;