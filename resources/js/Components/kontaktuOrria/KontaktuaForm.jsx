
import React, { useRef, useState } from "react";
import { usePage } from '@inertiajs/react';

function Kontaktua() {
    const [value, setValue] = useState(""); 
    const textareaRef = useRef(null); 
    const { translations } = usePage().props;
  
    const handleInput = (e) => {
      const textarea = textareaRef.current;
      setValue(e.target.value);
      textarea.style.height = "auto"; 
      textarea.style.height = `${textarea.scrollHeight}px`; 
    };
  return (
    <>
        <div className='kontaktatu'>
            <div>
                <h1>{translations.kontaktua.gurekin}</h1><br/>
            </div>  
            <div className='blanco2'>
                <div className='kontakt'>
                    <p>{translations.kontaktua.iritzia}</p>
                    <form>
                        <div className="form-row">
                            <div className="form-group col-md-6">
                                
                                <input type="text"  id="inputEmail" placeholder={translations.kontaktua.izena}/>
                                
                                
                                <input type="text" id="abizenaInput" placeholder={translations.kontaktua.abizena}/>
                            </div>
                            <div className="form-group col-md-6">
                                
                                <input type="email" id="emailInput" placeholder="email"/>
                                
                                <input type="number" id="telInput" placeholder="640 26 60 09"/>
                            </div>
                            <div className="form-group col-md-6">
                                
                                <textarea 
                                    name="mazuaInput" 
                                    id="mezuaInput"
                                    placeholder={translations.kontaktua.mezua}
                                    ref={textareaRef}
                                    value={value}
                                    onChange={handleInput} 
                                ></textarea>
                            </div>
                            <div className="form-group">
                                
                                <button className='bidali'>{translations.kontaktua.bidali}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        </>
    );
}

export default Kontaktua;