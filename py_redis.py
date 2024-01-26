import sys
import redis
from datetime import datetime
from datetime import datetime, timedelta

# Pour modifier le délai, changer la valeur de time_to_wait (minutes)
time_to_wait = .1
client = redis.Redis(host="localhost", port=6379)
argv = sys.argv

def get_value(key):
    client.get(key)
    
def add_conn(user_id):
    date = datetime.now().strftime("%Y-%m-%d %H:%M:%S")
    last_conn = client.lrange(f"conn:{user_id}", 0, -1)
    for i in range(len(last_conn)):
        if (datetime.strptime(date, "%Y-%m-%d %H:%M:%S") - datetime.strptime(last_conn[i].decode("utf-8"), "%Y-%m-%d %H:%M:%S")) > timedelta(minutes=time_to_wait):
            client.lrem(f"conn:{user_id}", 0, last_conn[i])
    if len(client.lrange(f"conn:{user_id}", 0, -1)) < 10:
        client.lpush(f"conn:{user_id}", date)
        return True
    else:
        return False
    
def get_product(product_id):
    return client.get(f"product:{product_id}")

def get_product_quantity(product_id):
    return int(client.get(f"product:{product_id}:quantity"))

def get_user_inventory(user_id, product_id):
    return int(client.get(f"{user_id}:inventory:{product_id}"))
    
def buy(user_id, product_id):
    if get_product_quantity(product_id) > 0:
        pipe = client.pipeline()
        pipe.incr(f"{user_id}:inventory:{product_id}", 1)
        pipe.incr(f"product:{product_id}:quantity", -1)
        pipe.execute()
        res = True
    else: 
        res = False
    return res

def sell(user_id, product_id):
    if get_user_inventory(user_id, product_id) > 0: 
        pipe = client.pipeline()
        pipe.incr(f"{user_id}:inventory:{product_id}", -1)
        pipe.incr(f"product:{product_id}:quantity", 1)
        pipe.execute()
        res = True
    else:
        res = False
    return res

if __name__ == "__main__":
    argv = sys.argv
    
    if len(argv) == 3:
        if argv[1] == "connect":
            print(add_conn(argv[2]))
    elif len(argv) == 4:
        if argv[1] == "buy":
            print(buy(argv[2], argv[3]))
        elif argv[1] == "sell":
            print(sell(argv[2], argv[3]))
    
    
