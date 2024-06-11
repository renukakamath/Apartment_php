package com.example.apartmentmanagement;

import androidx.appcompat.app.AlertDialog;
import androidx.appcompat.app.AppCompatActivity;

import android.content.DialogInterface;
import android.content.Intent;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.preference.PreferenceManager;
import android.util.Log;
import android.view.View;
import android.widget.AdapterView;
import android.widget.ArrayAdapter;
import android.widget.ListView;
import android.widget.Toast;

import org.json.JSONArray;
import org.json.JSONObject;

public class Viewcart extends AppCompatActivity implements JsonResponse, AdapterView.OnItemClickListener {
    ListView l1;
    SharedPreferences sh;
    String[] shop_name, product_name, quantity, image, total, stat, value, ordermaster_id;
    public static String omid, tot,sta;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_viewcart);
        l1 = (ListView) findViewById(R.id.list);
        l1.setOnItemClickListener(this);
        sh = PreferenceManager.getDefaultSharedPreferences(getApplicationContext());
        JsonReq JR = new JsonReq();
        JR.json_response = (JsonResponse) Viewcart.this;
        String q = "?action=Viewcart&login_id=" + sh.getString("log_id", "");
        q = q.replace(" ", "%20");
        JR.execute(q);
    }

    @Override
    public void response(JSONObject jo) {


        try {

            String status = jo.getString("status");
            Log.d("pearl", status);


            if (status.equalsIgnoreCase("success")) {
                JSONArray ja1 = (JSONArray) jo.getJSONArray("data");

                shop_name = new String[ja1.length()];
                product_name = new String[ja1.length()];
                quantity = new String[ja1.length()];
                image = new String[ja1.length()];
                total = new String[ja1.length()];
                stat = new String[ja1.length()];

                ordermaster_id = new String[ja1.length()];

                value = new String[ja1.length()];


                String[] value = new String[ja1.length()];

                for (int i = 0; i < ja1.length(); i++) {
                    shop_name[i] = ja1.getJSONObject(i).getString("shop_name");
                    product_name[i] = ja1.getJSONObject(i).getString("product_name");
                    quantity[i] = ja1.getJSONObject(i).getString("qty");
                    image[i] = ja1.getJSONObject(i).getString("image");
                    total[i] = ja1.getJSONObject(i).getString("total");
                    stat[i] = ja1.getJSONObject(i).getString("status");
                    ordermaster_id[i] = ja1.getJSONObject(i).getString("ordermaster_id");



                    value[i] = "shop name:" + shop_name[i] + "\nproduct name: " + product_name[i] + "\nquantity: " + quantity[i] + "\ntotal: " + total[i] + "\nstatus: " + stat[i];

                }
                ArrayAdapter<String> ar = new ArrayAdapter<String>(getApplicationContext(), R.layout.custtext, value);

                l1.setAdapter(ar);
                Custimage1 a = new Custimage1(this, shop_name, product_name,total,quantity,image);
                l1.setAdapter(a);
            }
        } catch (Exception e) {
            // TODO: handle exception
            e.printStackTrace();
            Toast.makeText(getApplicationContext(), e.toString(), Toast.LENGTH_LONG).show();

        }
    }

    @Override
    public void onItemClick(AdapterView<?> adapterView, View view, int i, long l) {
        omid = ordermaster_id[i];
        tot = total[i];
        sta = stat[i];

        if (sta.equalsIgnoreCase("pending")) {
            final CharSequence[] items = {"Make Payement", "Cancel"};

            AlertDialog.Builder builder = new AlertDialog.Builder(Viewcart.this);
            builder.setItems(items, new DialogInterface.OnClickListener() {
                @Override
                public void onClick(DialogInterface dialog, int item) {


                    if (items[item].equals("Make Payement")) {
                        startActivity(new Intent(getApplicationContext(), Makepayment.class));

                    } else if (items[item].equals("Cancel")) {
                        dialog.dismiss();
                    }

                }

            });
            builder.show();
        }
    }
}
