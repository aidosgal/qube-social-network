import { Outlet } from "react-router-dom";
import { BiSearch } from "react-icons/bi";
import { GrLocation } from "react-icons/gr";

export default function DefaultLayout() {
    return(
        <>
            <nav>
                <div className='flex p-3 px-20'>
                    <div className="my-auto">
                        <a href="/">qube</a>
                    </div>
                    <div className='flex ml-2 my-auto'>
                        <div className="relative rounded-md">
                            <div className="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3 pr-1">
                                <span className="text-gray-600 sm:text-lg"><BiSearch /></span>
                            </div>
                            <input
                            type="text"
                            name="search"
                            id="search"
                            className="block w-full rounded-md border-0 py-1.5 pl-8 pr-20 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-1 focus:ring-inset focus:ring-blue-400 sm:text-sm sm:leading-6"
                            placeholder="Поиск"
                            />
                         </div>
                        <div className='my-auto ml-2 flex cursor-pointer'> 
                            <div className='text-2xl text-gray-300'>
                                <GrLocation/>
                            </div>
                            <p className='ml-1'>г. Астана</p>
                        </div>
                    </div>
                    <div className='flex ml-auto my-auto'>
                        <div>Тема</div>
                        <a href="/login">Вход</a>
                    </div>
                </div>
                <hr/>
            </nav>
            <Outlet />
        </>
    )
}
