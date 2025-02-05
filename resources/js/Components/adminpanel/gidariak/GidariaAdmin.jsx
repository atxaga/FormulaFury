import { usePage } from '@inertiajs/react';
import HeaderAdmin from './HeaderAdmin';
import Liga from './Gidaria';
import '@/../css/adminpanel/ligak/nagusia.css';
import Footer from '@/Components/aktibitatea/Footer';
import Gidaria from './Gidaria';


function GidariaAdmin(){
    const { gidariak = []} = usePage().props;
    return(
        <>  
        <div className='dena bg-black'>
            <HeaderAdmin />
            {gidariak.length > 0 ? 
                gidariak.map((gidaria) =>(
                    <Gidaria gidaria={gidaria} />
                )):(
                    <p>Ez daude ligarik</p>
                )   

            }
            </div>
        </>
    )
}
export default GidariaAdmin;