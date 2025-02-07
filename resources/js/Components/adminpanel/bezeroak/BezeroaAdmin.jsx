import { usePage } from '@inertiajs/react';
import HeaderAdmin from './HeaderAdmin';
import Liga from './Bezeroa';
import '@/../css/adminpanel/ligak/nagusia.css';
import Footer from '@/Components/aktibitatea/Footer';
import Bezeroa from './Bezeroa';


function BezeroaAdmin(){
    const { bezeroak = []} = usePage().props;
    return(
        <>  
        <div className='dena bg-black'>
            <HeaderAdmin />
            <div style={{ 
                    display: 'flex', 
                    justifyContent: 'center', 
                    alignItems: 'center', 
                }}>
                    <div style={{ 
                        display: 'grid', 
                        gridTemplateColumns: 'repeat(2, 1fr)', 
                        gap: '20px', 
                        justifyContent: 'center',
                        marginLeft:'4%'                   
                         }}>
            {bezeroak.length > 0 ? 

                bezeroak.map((bezeroa) =>(
                    <Bezeroa bezeroa={bezeroa} />
                )):(
                    <p>Ez daude bezerorik</p>
                )   
            }
            </div>
            </div>
            </div>
        </>
    )
}
export default BezeroaAdmin;