#ifndef CJSONDATA_H
#define CJSONDATA_H

#include <QJsonArray>
#include <QJsonDocument>
#include <QJsonObject>
#include <QString>
#include <QObject>

class CJsonData : public QObject
{
	Q_OBJECT
	static CJsonData* dataInst;
	QJsonObject data;
	CJsonData();
	~CJsonData();
public:
	static CJsonData* getInstance();
	void setData(const QString&, const QString&);
	const QJsonObject& getData() const {return data;}
	void clearData();
signals:
	void readyToPost();
};

#endif // CJSONDATA_H
