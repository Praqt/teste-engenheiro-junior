import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { Head, useForm } from "@inertiajs/react";

export default function Form({ auth, product }) {
    const {data, setData, post, put, processing, errors} = useForm({
        name: product ? product.name : "",
        price: product ? product.price : "",
        stock: product ? product.stock : "",
    });
    
    function handleSubmit(e) {
        e.preventDefault();
        
        if (product === undefined)
            post(route("dashboard.products.store"));
        else
            put(route("dashboard.products.update", product.id));
    }

    return (
        <AuthenticatedLayout user={auth.user}
            header={
                <div className="flex justify-between">
                    <h2 className="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">{product ? "Alterar Produto" : "Novo Produto"}</h2>
                </div>
            }
        >
            <Head title="Products" />

            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div className="bg-white dark:bg-gray-800 w-1/2 mx-auto overflow-hidden shadow-sm sm:rounded-lg">
                        <form onSubmit={handleSubmit} className="flex flex-col gap-y-5 py-10 items-center">
                            <label className="flex flex-col">
                                <span className="text-gray-200">Nome do Produto</span>
                                <input type="text" placeholder="" value={data.name}
                                    onChange={e => setData("name", e.target.value)}
                                    disabled={product !== undefined}
                                    className={`form-input rounded-md shadow-sm ${product !== undefined && "opacity-70"}`} />
                                
                                {errors.name !== undefined && <span className="text-red-500">{errors.name}</span>}
                            </label>
                            <label className="flex flex-col">
                                <span className="text-gray-200">Preço do Produto</span>
                                <input type="text" placeholder="" value={data.price}
                                    onChange={e => setData("price", e.target.value)}
                                    className="form-input rounded-md shadow-sm" />
                                {errors.price !== undefined && <span className="text-red-500">{errors.price}</span>}
                            </label>
                            <label className="flex flex-col">
                                <span className="text-gray-200">Estoque</span>
                                <input type="number" placeholder="" value={data.stock}
                                    onChange={e => setData("stock", e.target.value)}
                                    className="form-input rounded-md shadow-sm" />
                                {errors.stock !== undefined && <span className="text-red-500">{errors.stock}</span>}
                            </label>
                            
                            <button type="submit" disabled={processing}
                                className="text-gray-100 mt-5 bg-red-900 px-5 py-2.5 font-bold rounded-lg">
                                Enviar
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    )
}